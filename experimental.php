<?php
declare(strict_types=1);

/**
 * Pizza class
 *
 * The Pizza class is meant to contain information about a pizza, specifically the name, the price, and whether it is a valid pizza.
 * Hawaii pizza is NOT valid pizza.
 * Class Pizza
 */
class Pizza
{
    private string $name;
    private int $price;
    private bool $isValid;

    public function __construct(string $name, int $price, bool $isValid = true)
    {
        $this->name = $name;
        $this->price = $price;
        $this->isValid = $isValid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }
}

/**
 * Class Customer
 *
 * Customer Class is intended to retain the name and location of a customer
 */
class Customer
{
    private string $name;
    private string $location;

    public function __construct(string $name, string $location)
    {
        $this->name = $name;
        $this->location = $location;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

}

/**
 * this function orders a pizza for a customer and echoes details about the order
 * @param Pizza $pizza pizza object to be ordered
 * @param Customer $customer customer to whom the pizza is to be sent
 * @throws Exception when the pizza is not valid this function will throw an exception. No pineapple here!
 */
function orderPizza(Pizza $pizza, Customer $customer): void
{
    //validate pizza
    if (!$pizza->isValid())
    {
        throw new Exception('computer says no');
    }

    //echo order confirmation and information
    echo "Creating new order... <br>";
    echo "A " . $pizza->getName() . " pizza should be sent to " . $customer->getName() . "<br>";
    echo "The address: " . $customer->getName() . "<br>";
    echo "The bill is €" . $pizza->getPrice() . "<br>";
    echo "Order finished.<br><br>";
}

/**
 * tests whether the pizza exists at all and echoes the name of the pizza. fascinating, really don't need this,
 * but might be upgraded in the future to have some actual functionality.
 * @param Pizza $pizza pizza to be tested
 */
function test(Pizza $pizza): void
{
    echo "Test: type is " . $pizza->getName() . "<br>";
}

/**
 * big controller function that orders a series of pizzas for a series of customers.
 */
function orderPizzaAll()
{
    //define a group of customers and pizzas which we can draw from
    //TODO: figure out a better way to handle these. Probably encapsulate these in their own classes.
    $customers = [
        'Koen' => new Customer('Koen', 'a yacht in Antwerp'),
        'Manuele' => new Customer('Manuele', 'somewhere in Belgium'),
        'Students' => new Customer('students', 'BeCode office'),
    ];

    $pizzas = [
        'calzone' => new Pizza('calzone', 10),
        'golden' => new Pizza('golden', 100),
        'margherita' => new Pizza('margherita', 5),
        'hawaii' => new Pizza('hawaii', 10, false),
    ];

    try
    {
        orderPizza($pizzas['calzone'], $customers['Koen']);
        orderPizza($pizzas['margherita'], $customers['Manuele']);
        orderPizza($pizzas['golden'], $customers['Students']);
        //TODO: comment out next line after testing, because we do not tolerate pineapple around here.
//        orderPizza($pizzas['hawaii'], $customers['Students']);
    }
    catch (Exception $e)
    {
        echo $e;
    }
}

orderPizzaAll();