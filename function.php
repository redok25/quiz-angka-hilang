<?php

function permutations(array $elements, $limit)
{
    if( $limit == 1 )
    {
        // No need to go deeper, return a list of all remaining letters
        foreach($elements as $element)
            yield array($element);
    }

    foreach($elements as $i => $element)
    {
        // compute all the permutions, without the elements at index i
        $sub_perms = permutations( array_merge(array_slice($elements, 0, $i), array_slice($elements, $i+1)), $limit-1);

        // list all the permutations with the currently selected element + all the possible combinations of $limit-1 letters of the others elements 
        foreach($sub_perms as $sub_perm)
        {
            yield array_merge(array($element), $sub_perm);
        }
    }
}