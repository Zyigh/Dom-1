<?php
namespace Gt\Dom;

/**
 * Contains methods that are particular to Node objects that can have children.
 *
 * This trait can only be used in a class that is a trait of LiveProperty.
 *
 * This trait is used by the following classes:
 *  - Element
 *  - Document
 *  - DocumentFragment
 * @property-read HTMLCollection $children A live HTMLCollection containing all
 *  objects of type Element that are children of this ParentNode.
 * @property-read Element|null $firstElementChild The Element that is the first
 *  child of this ParentNode.
 * @property-read Element|null $lastElementChild The Element that is the last
 *  child of this ParentNode.
 * @property-read int $childElementCound The amount of children that the
 *  ParentNode has.
 */
trait ParentNode {

public function contains(Element $node):bool {
	foreach($this->children as $child) {
		if($child === $node) {
			return true;
		}

		if($child->contains($node)) {
			return true;
		}
	}

	return false;
}

private function prop_get_children():HTMLCollection {
	return new HTMLCollection($this->childNodes);
}

private function prop_get_firstElementChild() {
	return $this->children->item(0);
}

private function prop_get_lastElementChild() {
	return $this->children->item($this->children->length - 1);
}

private function prop_get_childElementCount() {
	return $this->children->length;
}

}#