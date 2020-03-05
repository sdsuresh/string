<?php

namespace Tests\Unit;

use Tests\TestCase;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Tester\CommandTester;

class StringTest extends TestCase
{
    public function test_string()
    {
        $application = app()->makeWith(\Illuminate\Console\Application::class, [
            'version' => $this->app::VERSION
        ]);

        $application->add(
             $application->resolve(
                'App\Console\Commands\InputString'
             )
        );

        $command = $application->find('input:string');
        $commandTester = new CommandTester($command);

        // Equals to a user inputting "hello world" and hitting ENTER, here we can set input dynamically also like random string or like using factory seeder, to keeo it simple i added the text for demo purpose.
        $commandTester->setInputs(['hello world']);

        $commandTester->execute(['command' => $command->getName()]);
echo $command->getName();
        $expected = "\n" .
            " Please enter a string:\n" .
             " > \n" .
            "HELLO WORLD\n" .
            "hElLo wOrLd\n" .
            "CSV created!\n";

          //THis assert is just to check if the expected output and the actuall output matches.
          $this->assertEquals(
            $expected,
            $commandTester->getDisplay()
          );
    }
}
