<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Raffle;
use App\RaffleClient;

class CheckRafflesDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:raffles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica si hay sorteos proximos a realizarse en los seguidos 5 minutos desde que se ejecuto este comando y los procesa';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{

            DB::transaction(function(){

                // Se informa al usuario que el procesamiento comienza
                $output = new \Symfony\Component\Console\Output\ConsoleOutput();
                $output->writeln('<comment>-> Iniciando procesamiento...</comment>');
                $output->writeln('');

                $raffles = Raffle::where('status', 1)->where('raffle_date', '>', Carbon::now()->toDateTimeString())->where('raffle_date', "<", Carbon::now()->addMinutes(6)->toDateTimeString())->get(); // Se define 1 minuto extra para que no falte algun sorteo definido en el minuto justo
        
                $listRaffles = [];
                foreach($raffles as $raffle){
                    $listWinners = [];
                    $ids = RaffleClient::where('raffle_id', $raffle->id)->where('status', 0)->where('paid', 1)->orderBy('client_id', 'ASC')->pluck('client_id')->toArray();

                    if($raffle->multiple_winners === 1){ // Multiples ganadores

                        for ($i = 0; count($listWinners) < $raffle->extra_winners; $i) {
                            array_values($ids);
                            $randomValue = mt_rand($ids[array_key_first($ids)], $ids[count($ids)-1]);
                            $search = array_search($randomValue, $ids); // Verificamos si el numero seleccionado esta entre los disponibles

                            if(gettype($search) == "integer" && $search !== false){
                            
                                $searchInWinners = array_search($randomValue, $listWinners);

                                if(gettype($searchInWinners) == "boolean" && $searchInWinners == false){
                                    
                                    array_push($listWinners, $randomValue);

                                    RaffleClient::where('raffle_id', $raffle->id)->where('client_id', $randomValue)->update(['status' => 1]);
                                }
                            }
                        }

                        Log::info("Command::CheckRafflesDate - Ganadores del sorteo $raffle->id: " . json_encode($listWinners));
                        $output->writeln("<info>-> Ganadores del sorteo $raffle->id: ". json_encode($listWinners) ."</info>");

                    } else { // Un solo ganador

                        for ($i = 0; $i < 1; $i) {
                            array_values($ids);
                            $randomValue = mt_rand($ids[array_key_first($ids)], $ids[count($ids)-1]);
                            $search = array_search($randomValue, $ids); // Verificamos si el numero seleccionado esta entre los disponibles

                            if(gettype($search) == "integer" && $search !== false){
                            
                                $listWinners[0] = $randomValue;
                                RaffleClient::where('raffle_id', $raffle->id)->where('client_id', $randomValue)->update(['status' => 1]);

                                $i = 2;

                                Log::info("Command::CheckRafflesDate - Ganador del sorteo $raffle->id: " . json_encode($listWinners));
                                $output->writeln("<info>-> Ganador del sorteo $raffle->id: ". json_encode($listWinners) ."</info>");
                            }
                        }
                    }

                    $checkUpdated = Raffle::where('id', $raffle->id)->update(['status' => 3]);

                    if($checkUpdated > 0){
                        
                        array_push($listRaffles, $raffle->id);
                    }
                }

                if($listRaffles == []){
                    $listRaffles = 0;
                } else {
                    $listRaffles = json_encode($listRaffles);
                }

                $output->writeln('');
                $output->writeln('<comment>-> Se procesaron correctamente los datos, sorteos finalizados: '. $listRaffles .'</comment>');
            });

        } catch(\Exception $e){

            Log::error('Command::CheckRafflesDate - ' . $e->getMessage(), ['error_line' => $e->getLine()]);

            $output = new \Symfony\Component\Console\Output\ConsoleOutput();
            $output->writeln('<error>Hubo un error al procesar los sorteos, verifique el archivo log en sortealo/storage/logs/laravel.log</error>');
        }
    }
}
