<?php

namespace App\Console\Commands;

use App\Mail\SendContact;
use App\Mail\SendRotinaSumulas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RotinaSumulas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rotina:sumulas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando verifica os prazo das Súmulas';

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
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->rerturnParlamentaresSumulas() as $parlamentar) {



            $data = $this->returnSumulasParlamentares($parlamentar->parlamentar_id);

            Mail::to($parlamentar->email)->send(new SendRotinaSumulas($data));


        }

        shell_exec('touch teste.txt');

        echo "deu certo \n";

    }

    public function rerturnParlamentaresSumulas()
    {
        $data = DB::table('sumulas')
            ->select('sumulas.parlamentar_id','users.email')
            ->join('parlamentars', 'sumulas.parlamentar_id', '=', 'parlamentars.id')
            ->join('users', 'parlamentars.user_id', '=', 'users.id')
            ->where([
                ['sumulas.date_start', '!=', null],
                ['sumulas.status', '=', 'A']
            ])
            ->groupBy('sumulas.parlamentar_id')
            ->get();


        return $data;
    }

    public function returnSumulasParlamentares($parlamentar)
    {
        $data = DB::table('sumulas')
            ->join('parlamentars', 'sumulas.parlamentar_id', '=', 'parlamentars.id')
            ->join( 'users', 'parlamentars.user_id', '=', 'users.id')
            ->where([
                ['sumulas.date_start', '!=', null],
                ['sumulas.status', '=', 'A'],
                ['sumulas.parlamentar_id', '=', $parlamentar]
            ])
            ->orderBy('sumulas.date_start', 'ASC')
            ->get();

        return $data;
    }
}
