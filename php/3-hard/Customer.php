<?php

declare(strict_types=1);


namespace App;


class Customer
{
    //=========== Declare var for visibility
    private string $name;
    private array $rentals = [];

    public function __construct(String $name)
    {
        $this->name = $name;
    }

    //======== No need return and add void return
    public function addRental(Rental $rental): void
    {
        $this->rentals[] = $rental;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function statement(): string
    {
        $totalAmount = 0.0;
        $frequentRenterPoints = 0;

        $result = "Rental Record for {$this->getName()}\n";
        // $result = "Rental Record for " . $this->getName() . "\n";

        //========= Change each to rental for clarity and visibility
        foreach ($this->rentals as $rental) {
            $thisAmount = 0.0;

            /* @var $rental Rental */
            // determines the amount for each line
            switch ($rental->getMovie()->getPriceCode()) {
                case Movie::REGULAR:
                    $thisAmount += 2;
                    if ($rental->getDaysRented() > 2)
                        $thisAmount += ($rental->getDaysRented() - 2) * 1.5;
                    break;
                case Movie::NEW_RELEASE:
                    $thisAmount += $rental->getDaysRented() * 3;

                    //============ Move check daysRented here
                    if ($rental->getDaysRented() > 1) {
                        $frequentRenterPoints++;
                    }
                    break;
                case Movie::CHILDREN:
                    $thisAmount += 1.5;
                    if ($rental->getDaysRented() > 3) {
                        $thisAmount += ($rental->getDaysRented() - 3) * 1.5;
                    }
                    break;
            }

            $frequentRenterPoints++;

            $result .= "\t{$rental->getMovie()->getTitle()}\t" . number_format($thisAmount, 1) . "\n";
            // $result .= "\t" . $rental->getMovie()->getTitle() . "\t"
            //     . number_format($thisAmount, 1) . "\n";
            $totalAmount += $thisAmount;
        }

        $result .= "You owed " . number_format($totalAmount, 1)  . "\n";
        $result .= "You earned {$frequentRenterPoints} frequent renter points\n";

        return $result;
    }
}
