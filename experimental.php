<?php
declare(strict_types=1);


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
 * this function orders a pizza for a customer and echoes details about the order
 * @param Pizza $pizza pizza object to be ordered
 * @param string $forWho who the pizza is being ordered for
 */
function orderPizza(Pizza $pizza, string $forWho): void
{
    //validate pizza
    if(!$pizza->isValid())
    {
        return;
    }

    echo "Creating new order... <br>";
    $totalPrice = $pizza->getPrice();

    // TODO: for now this is fine but in the long run, it'd be nicer to replace this with objects.
    $address = match ($forWho)
    {
        'koen' => 'a yacht in Antwerp',
        'manuele' => 'somewhere in Belgium',
        'students' => 'BeCode office',
        default => 'unknown'
    };

    echo "A " . $pizza->getName() . " pizza should be sent to " . $forWho . "<br>";
    echo "The address: " . $address . "<br>";
    echo "The bill is €" . $totalPrice . "<br>";


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
 * !!DEPRECATED!!
 * original intent was to calculate the cost of a pizza by the name of the pizza.
 * this functionality has been relegated to the pizza class itself, so every pizza object knows its own price.
 * however, we're keeping this chunk of code around for now because it has some legacy code on handling non-valid pizzas like hawaii
 *
 * TODO: implement throw exception for invalid pizza and remove this function entirely.
 *
 * TODO: replace with some sort of validation function
 * @param Pizza $pizza Pizza we need the price for
 * @return int price of the pizza
 * @throws Exception exception is thrown in case the computer does not like this particular pizza.
 */
function calculateCost(Pizza $pizza): int
{
    if ($pizza->isValid())
    {
        return $pizza->getPrice();
    }
    else
    {
        throw new \RuntimeException('compuster says no');
    }
}

/**
 * big controller function that orders a series of pizzas for a series of customers.
 */
function orderPizzaAll()
{
    try
    {
        orderPizza(new Pizza('calzone', 10), 'koen');
        orderPizza(new Pizza('marguerita', 5), 'manuele');
        orderPizza(new Pizza('golden', 100), 'students');
        orderPizza(new Pizza('hawaii', 5, false), 'students');
    }
    catch (Exception $e)
    {
        echo $e;
    }
}

orderPizzaAll();