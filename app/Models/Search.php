<?php

namespace App\Models;

trait Search
{
    private function buildWildCards($term) {
        if ($term == "") {
            return $term;
        }

        // strip MySQL reserved symbols
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);
        foreach($words as $idx => $word) {
            $words[$idx] = "+" . $word . "*";
        }
        $term = implode(' ', $words);
        return $term;
    }

    protected function scopeSearch($query, $term) {
        $columns = implode(',', $this->searchable);

        // match john* for words starting with john
        $query->whereRaw(
            "MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)",
            $this->buildWildCards($term)
        );
        return $query;
    }
}
