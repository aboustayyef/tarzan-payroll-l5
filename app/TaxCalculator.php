<?php

namespace App;


class TaxCalculator
{

/*
	Chargeable Income (GH¢)	Rate (%)	Tax (GH¢)	Cumulative Chargeable Income (GH¢)	Cumulative Tax (GH¢)
	First 216				NIL			NIL			216									NIL
	Next 108				5			5.40		324									5.40
	Next 151				10			15.10		475									20.50
	Next 2,765				17.5		483.88		3240								504.38
	Exceeding 3,240	25	 	 	 
*/

	private $brackets = 
	[
		216	=>	0,
		108 => 0.05,
		151	=> 0.1,
		2765 =>	0.175,
		1000000000000 => 0.25
	];

	public function getBrackets($amount)
	{
		$result = [];
		$remaining_amount = $amount;
		foreach ($this->brackets as $bracket => $tax) {
			if ($remaining_amount - $bracket > 0) {
				$result[] = $bracket;
				$remaining_amount = $remaining_amount - $bracket;
			} else {
				$result[] = $remaining_amount;
				return $result;
			}
		}
	}

	public function getTax($amount)
	{
		$result = 0;
		$remaining_amount = $amount;
		foreach ($this->brackets as $bracket => $tax) {
			if ($remaining_amount - $bracket > 0) {
				$result += $bracket * $tax;
				$remaining_amount = $remaining_amount - $bracket;
			} else {
				$result += $remaining_amount * $tax;
				return round($result,2);
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
	public function brackets($amount)
	{
		// testing
		$available_brackets = [200,500,1000,2500];
		$result = [];
		foreach ($available_brackets as $key => $bracket) {
			if ($amount - $bracket > 0) {
				$result[] = $bracket;
				$amount = $amount - $bracket;
			} else {
				$result[] = $amount;
				return $result;
			}
		}
		$result[] = $amount;
		return $result;
	}

 */
