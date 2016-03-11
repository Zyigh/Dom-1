<?php
namespace phpgt\dom;

class HTMLCollectionTest extends \PHPUnit_Framework_TestCase {

public function testType() {
	$document = new HTMLDocument(test\Helper::HTML);
	$this->assertInstanceOf("\phpgt\dom\HTMLCollection", $document->children);
}

public function testNonElementsRemoved() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$bodyChildNodes = $document->body->childNodes;
	$bodyChildren = $document->body->children;

	$this->assertInstanceOf("\DOMNodeList", $bodyChildNodes);
	$this->assertInstanceOf("\phpgt\dom\HTMLCollection", $bodyChildren);

	$this->assertInstanceOf("\phpgt\dom\Text", $bodyChildNodes->item(0));
	$this->assertInstanceOf("\phpgt\dom\Element", $bodyChildren->item(0));
}

public function testNamedItem() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$collection = $document->body->children;

	$idMatch = $collection->namedItem("firstParagraphTag");
	$this->assertSame($document->getElementById("firstParagraphTag"), $idMatch);

	$nameMatch = $collection->namedItem("forms");
	$this->assertSame($document->querySelector("[name='forms']"), $nameMatch);

	$nothingMatch = $collection->namedItem("nothing");
	$this->assertNull($nothingMatch);
}

}#