<?php
/*
class President
{
    public $name = "Barack Obama";

    public function greet($name)
    {

        return "Hello $name, my name is $this->name, nice to meet you!";
    }
}

$us_president = new President();

$president_name = $us_president->name;
$greetings_from_president = $us_president->greet(name: "Donald");

echo $president_name;
echo "<br>";
echo $greetings_from_president;

//tarea 2

class Person
{
    public $first_name;
    public $last_name;
    public function __construct($first_name, $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }
    public function get_full_name()
    {
        return $this->first_name . " " . $this->last_name;
    }
}
$nombrecompleto = new Person("Hugo", "Enrique");
echo $nombrecompleto->get_full_name();

//tarea 3

class CurrentUSPresident
{
    const name = "Barack Obama";

    public static function greet($name)
    {

        return "Hello $name, my name is " . self::name . ", nice to meet you!";
    }
}


echo CurrentUSPresident::greet(name: "Donald");

//tarea 4


class Person
{
    const species = "Homo Sapiens";
    public $name;
    public $age;
    public $occupation;

    public function  __construct($name, $age, $occupation)
    {
        $this->name = $name;
        $this->age = $age;
        $this->occupation = $occupation;
    }


    public function introduce()
    {
        return "Hello, my name is " . $this->name;
    }

    public function describe_job()
    {
        return "I am currently working as a(n) " . $this->occupation;
    }

    public static function greet_extraterrestrials($species)
    {
        return 'Welcome to Planet Earth ' . $species . '!';
    }

    
}

//tarea 5

*/

class Person
{
    const species = "Homo Sapiens";
    public $name;
    public $age;
    public $occupation;

    public function  __construct($name, $age, $occupation)
    {
        $this->name = $name;
        $this->age = $age;
        $this->occupation = $occupation;
    }


    public function introduce()
    {
        return "Hello, my name is " . $this->name;
    }

    public function describe_job()
    {
        return "I am currently working as a(n) " . $this->occupation;
    }

    public static function greet_extraterrestrials($species)
    {
        return 'Welcome to Planet Earth ' . $species . '!';
    }
}

class Salesman extends Person  {

public function __construct($name, $age)
{
    parent::__construct($name, $age,"Salesman");
   
    
}

public function introduce()
    {
        return "Hello, my name is $this->name, don't forget to check out my products!";
    }


}
class ComputerProgrammer extends Person  {
   
public function __construct($name, $age)
{
    parent::__construct($name, $age, "Computer Programmer");
    
}

public function describe_job()
{
    return parent::describe_job()."don't forget to check out my Codewars account ;)";
}


}


class WebDeveloper extends ComputerProgrammer{

function __construct($name, $age)
{
    parent::__construct($name, $age);
    $this->occupation="Web Developer";
}


public function describe_job()
{
    return parent::describe_job()."And don't forget to check on my website :D";
}



public function describe_website(){
return "My professional world-class website is made from HTML, CSS, Javascript and PHP!";

}




}
