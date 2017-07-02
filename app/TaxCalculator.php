<?php

namespace App;


class TaxCalculator
{

	private $brackets = 
	[
		216	=>	0,
		108 => 0.5,
		151	=> 0.1,
		2765 =>	0.175,
		1000000000000 => 0.25
	];

	public function getBrackets($figure)
	{
		$result = [];
		foreach ($this->brackets as $bracket => $tax) {
			if ($figure - $bracket > 0) {
				$result[] = $bracket;
				$figure = $figure - $bracket;
			} else {
				$result[] = $figure;
				return $result;
			}
		}
	}

	public function getTax($figure)
	{
		$result = 0;
		foreach ($this->brackets as $bracket => $tax) {
			if ($figure - $bracket > 0) {
				$result += $bracket * $tax;
				$figure = $figure - $bracket;
			} else {
				$result += $figure * $tax;
				return $result;
			}
		}
	}

}

/*
IIf(
	[Net_Taxable]>3240,
		(([Net_Taxable]-3241)*0.25)+483.875+15.1+5.4+0,IIf([Net_Taxable]>475,(([Net_Taxable]-476)*0.175)+15.1+5.4+0,IIf([Net_Taxable]>324,(([Net_Taxable]-325)*0.1)+5.4+0,IIf([Net_Taxable]>216,(([Net_Taxable]-217)*0.05),0)))
	)
 */

/*
	public function brackets($figure)
	{
		// testing
		$available_brackets = [200,500,1000,2500];
		$result = [];
		foreach ($available_brackets as $key => $bracket) {
			if ($figure - $bracket > 0) {
				$result[] = $bracket;
				$figure = $figure - $bracket;
			} else {
				$result[] = $figure;
				return $result;
			}
		}
		$result[] = $figure;
		return $result;
	}

 */
