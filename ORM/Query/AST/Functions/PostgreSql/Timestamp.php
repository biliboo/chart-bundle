<?php

namespace Biliboo\ChartBundle\ORM\Query\AST\Functions\PostgreSql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\Lexer;

/**
 * TIMESTAMP ::= "TIMESTAMP" "(" DateTime ")"
 */
class Timestamp extends FunctionNode
{
    /**
     * @var ArithmeticPrimary
     */
    private $dateExpression;

    /**
     * @param Parser $parser
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->dateExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * @param SqlWalker $sqlWalker
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf(
            'EXTRACT(epoch from %s)',
            $this->dateExpression->dispatch($sqlWalker)
        );
    }
}

