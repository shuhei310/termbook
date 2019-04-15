<?php
class TermRules
{
    public static function _validation_unique($val, $options)
    {
        list($table, $field) = explode('.', $options);

        $result = DB::select($field)
        ->where($field, '=', Str::lower($val))
        ->and_where('del_flg', '=', 0)
        ->from($table)->execute();

        return ! ($result->count() > 0);
    }

    public static function _validation_no_match_value($val, $compare, $strict = false)
	{
		// first try direct match
		if (empty($val) || $val !== $compare || ( ! $strict && $val != $compare))
		{
			return true;
		}

		// allow multiple input for comparison
		if (is_array($compare))
		{
			foreach($compare as $c)
			{
				if ($val !== $c || ( ! $strict && $val != $c))
				{
					return true;
				}
			}
		}

		// all is lost, return failure
		return false;
	}
}
