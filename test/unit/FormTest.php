<?php
namespace Gt\Dom\Test;

use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use PHPUnit\Framework\TestCase;

class FormTest extends TestCase {
	public function testMultipleRadioCanNotBeCheckedViaProperty() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
		$whiteRadio = $document->querySelector("input[value=white]");
		$blackRadio = $document->querySelector("input[value=black]");

		$whiteRadio->checked = true;

		self::assertTrue(
			$whiteRadio->hasAttribute("checked"),
			"Checked attribute should be present on white radio after setting property on white."
		);
		self::assertFalse(
			$blackRadio->hasAttribute("checked"),
			"Checked attribute should not be present on black radio after setting property on white."
		);

		$blackRadio->checked = true;

		self::assertFalse(
			$whiteRadio->hasAttribute("checked"),
			"Checked attribute should not be present on white after setting property on black."
		);
		self::assertTrue(
			$blackRadio->hasAttribute("checked"),
			"Checked attribute should be present on black after setting property on black."
		);
	}

	public function testMultipleRadioCanNotBeCheckedViaAttribute() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_RADIOS);
		$whiteRadio = $document->querySelector("input[value=white]");
		$blackRadio = $document->querySelector("input[value=black]");

		$blackRadio->setAttribute("checked", true);

		self::assertFalse(
			$whiteRadio->hasAttribute("checked"),
			"Checked attribute should not be present on white radio after setting attribute on white."
		);
		self::assertTrue(
			$blackRadio->hasAttribute("checked"),
			"Checked attribute should be present on black radio after setting attribute on black."
		);

		$whiteRadio->setAttribute("checked", true);

		self::assertTrue(
			$whiteRadio->hasAttribute("checked"),
			"Checked attribute should be present on white radio after setting attribute on white."
		);
		self::assertFalse(
			$blackRadio->hasAttribute("checked"),
			"Checked attribute should not be present on black radio after setting attribute on white."
		);
	}

	public function testSelectSingleViaValue() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_SELECT_SINGLE_AND_MULTIPLE);
		$singleSelect = $document->querySelector(".single-choice");
		$singleSelect->value = "white";

		self::assertTrue(
			$singleSelect->querySelector("[value=white]")->selected,
			"Selected property should be true on white option after setting select value to white."
		);
		self::assertFalse(
			$singleSelect->querySelector("[value=black]")->selected,
			"Selected property should be false on black option after setting select value to white."
		);

		$singleSelect->value = "black";

		self::assertFalse(
			$singleSelect->querySelector("[value=white]")->selected,
			"Selected property should be false on white option after setting select value to black."
		);
		self::assertTrue(
			$singleSelect->querySelector("[value=black]")->selected,
			"Selected property should be true on black option after setting select value to black."
		);
	}

	public function testSelectSingleViaProperty() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_SELECT_SINGLE_AND_MULTIPLE);
		$singleSelect = $document->querySelector(".single-choice");
		$singleSelect->querySelector("[value=white]")->selected = true;

		self::assertTrue(
			$singleSelect->querySelector("[value=white]")->selected,
			"Selected property should be true on white option after setting select value to white."
		);
		self::assertFalse(
			$singleSelect->querySelector("[value=black]")->selected,
			"Selected property should be false on black option after setting select value to white."
		);

		$singleSelect->querySelector("[value=black]")->selected = true;

		self::assertFalse(
			$singleSelect->querySelector("[value=white]")->selected,
			"Selected property should be false on white option after setting select value to black."
		);
		self::assertTrue(
			$singleSelect->querySelector("[value=black]")->selected,
			"Selected property should be true on black option after setting select value to black."
		);
	}

	public function testSelectMultipleViaValue() {
		$document = new HTMLDocument(Helper::HTML_FORM_WITH_SELECT_SINGLE_AND_MULTIPLE);
		$selectMulti = $document->querySelector(".multiple-choice");

		$selectMulti->querySelector("[value=gcse]")->selected = true;
		$selectMulti->querySelector("[value=a-level]")->selected = true;
		$selectMulti->querySelector("[value=degree]")->selected = true;

		self::assertTrue(
			$selectMulti->querySelector("[value=gcse]")
				->hasAttribute("selected")
		);
		self::assertTrue(
			$selectMulti->querySelector("[value=a-level]")
				->hasAttribute("selected")
		);
		self::assertTrue(
			$selectMulti->querySelector("[value=degree]")
				->hasAttribute("selected")
		);

		self::assertFalse(
			$selectMulti->querySelector("[value=nvq]")
				->hasAttribute("selected")
		);
		self::assertFalse(
			$selectMulti->querySelector("[value=apprenticeship]")
				->hasAttribute("selected")
		);
		self::assertFalse(
			$selectMulti->querySelector("[value=professional]")
				->hasAttribute("selected")
		);

	}
}