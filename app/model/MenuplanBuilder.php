<?php

namespace app\model;

class MenuplanBuilder {
	
	private function buildPlan($rows, $each) {
		$plan = array ();
		$i = 0;
		$menus = array ();
		foreach ( $rows as $row ) {
			$menu = $each ( &$plan, $row, $i );
			array_push ( $menus, $menu );
			$i ++;
		}
		$plan ['menus'] = $menus;
		return $plan;
	}
	
	public function buildDailyplan($rows) {
		$each = function ($plan, $row, $index) {
			if ($index == 0) {
				$plan ['mensa'] = $row ['name'];
				$plan ['date'] = $row ['date'];
			}
			return array (
					'title' => $row ['title'],
					'menu' => explode ( '|', $row ['menu'] ) 
			);
		};
		return $this->buildPlan ( $rows, $each );
	}
	
	public function buildWeeklyplan($rows) {
		$each = function ($plan, $row, $index) {
			if ($index == 0) {
				$plan ['mensa'] = $row ['name'];
				$plan ['week'] = $row ['week'];
			}
			return array (
					'title' => $row ['title'],
					'date' => $row ['date'],
					'day' => $row ['day'],
					'menu' => explode ( '|', $row ['menu'] ) 
			);
		};
		return $this->buildPlan ( $rows, $each );
	}
}
?>