<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\Helper;
use Illuminate\Http\Request;
use Validator;

class InputString extends Command
{
    private $helper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'input:string';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To input a string and output as UpperCase, alternate Uppercase and generate CSV';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->helper = new Helper();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Request $request)
    {
        try {
            $string = $this->ask('Please enter a string');

            //Validation
            $validator = Validator::make([
                'string' => $string
            ], [
                'string' => ['required']
            ]);

            $err_array = [];
            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $err_array[] = $this->info($this->error($error));
                }
                return $err_array;
            }

            //Upper Case
            $resp_upper_case = $this->helper->convertString($string, 'CAPS'); //2nd param is the flag to return whether upper case or alternate upper case. [CAPS | ALT-CAPS]
            $this->line($resp_upper_case);

            //Alternate Upper Case
            $resp_alt_upper_case = $this->helper->convertString($string, 'ALTCAPS'); 
            $this->line($resp_alt_upper_case);

            //CSV
            $resp_generate_csv = $this->helper->generateCSV($string); 
            if($resp_generate_csv){
                $this->line("CSV created!");
            }
        } catch(Exception $e){
            $this->error($e->getMessage());
        }
    }
}

