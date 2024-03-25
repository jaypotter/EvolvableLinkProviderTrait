<?php

declare(strict_types=1);

namespace Potter\Link\Provider\Evolvable;

use \Psr\Link\LinkInterface, \Traversable;

trait EvolvableLinkProviderTrait 
{
    final public function withLink(LinkInterface $link): static
    {
        $clone = $this->getClone();
        if (!$this->hasLink($link)) {
            return $clone;
        }
        $links = $this->getLinks();
        array_push($links, $link);
        $clone->setLinks($links);
        return $clone;
    }
    
    final public function withoutLink(LinkInterface $link): static
    {
        $clone = $this->getClone();
        if (!$this->hasLink($link)) {
            return $clone;
        }
        $newLinks = [];
        $links = $this->getLinks();
        foreach ($links as $newLink) {
            if ($newLink == $link) {
                continue;
            }
            array_push($newLinks, $link);
        }
        $clone->setLinks($newLinks);
        return $clone;
    }
    
    abstract public function getClone(): static;
    abstract public function getLinks(): array|Traversable;
    abstract public function hasLink(LinkInterface $link): bool;
    abstract protected function setLinks(array|Traversable $links): void;
}
