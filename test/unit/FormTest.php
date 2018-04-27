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

	public function testSelectNotMultipleViaValue() {
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
}