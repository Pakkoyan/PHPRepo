<?php

interface Operation {
    public function execute($a, $b): float;
}

interface CalculatorFactory {
    public function createOperation(): Operation;
}
    
class AdditionFactory implements CalculatorFactory {
    public function createOperation(): Operation {
        return new Addition();
    }
}

class SubtractionFactory implements CalculatorFactory {
    public function createOperation(): Operation {
        return new Subtraction();
    }
}

class MultiplicationFactory implements CalculatorFactory {
    public function createOperation(): Operation {
        return new Multiplication();
    }
}

class DivisionFactory implements CalculatorFactory {
    public function createOperation(): Operation {
        return new Division();
    }
}

class FactorialFactory implements CalculatorFactory {
    public function createOperation(): Operation {
        return new FactorialOperation();
    }
}

class FibonacciFactory implements CalculatorFactory {
    public function createOperation(): Operation {
        return new FibonacciOperation();
    }
}

class Addition implements Operation {
    public function execute($a, $b): float {
        return $a + $b;
    }
}

class Subtraction implements Operation {
    public function execute($a, $b): float {
        return $a - $b;
    }
}

class Multiplication implements Operation {
    public function execute($a, $b): float {
        return $a * $b;
    }
}

class Division implements Operation {
    public function execute($a, $b): float {
        if ($b == 0) {
            throw new InvalidArgumentException("Cannot divide by zero");
        }
        return $a / $b;
    }
}

class FactorialOperation implements Operation {
    public function execute($a, $b = null): float {
        if ($a == 0) {
            return 1;
        }

        return $a * $this->execute($a - 1);
    }
}

class FibonacciOperation implements Operation {
    public function execute($n, $b = null): float {
        if ($n == 1 || $n == 2) {
            return 1;
        }

        return $this->execute($n - 1) + $this->execute($n - 2);
    }
}

function main(): void
{
    echo "Введите первое число: ";
    $a = (float) fgets(STDIN);

    echo "Введите второе число: ";
    $b = (float) fgets(STDIN);

    echo "Выберите операцию +, -, *, /, !, f ";
    $operator = trim(fgets(STDIN));

    switch ($operator) {
        case '+':
            $factory = new AdditionFactory();
            break;
        case '-':
            $factory = new SubtractionFactory();
            break;
        case '*':
            $factory = new MultiplicationFactory();
            break;
        case '/':
            $factory = new DivisionFactory();
            break;
        case '!':
            $factory = new FactorialFactory();
            break;
        case 'f':
            $factory = new FibonacciFactory();
            break;
    }

    $operation = $factory->createOperation();
    $result = $operation->execute($a, $b);
    echo "{$result}\n";
}

main();


