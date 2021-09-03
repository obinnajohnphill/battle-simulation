<?php

namespace App\Helper;


use Randomiser;

/**
 * A class that generates random words for the battle messages
 */
class TextGenerator {
    private $randomise;
    private $verbs           = ['flung', 'flicked', 'threw', 'slid', 'heaved', 'swung', 'fired', 'nudged'];
    private $adjectives      = ['weapon' => ['whirling', 'spinning', 'flaming', 'grinning',  'really hot', 'lancing', 'mighty', 'ice cold'],
                                'dodge'  => ['illegal', 'dazzling', 'scary', 'disappointing', 'impressive', 'blinding', 'brilliant', 'boring', 'scorn-worthy',
                                             'unacceptable', 'unbelievable', 'totally believable']
                               ];
    private $nouns           = ['fish', 'lance', 'sword', 'tree', 'shoe', 'train', 'pigeon', 'pen'];
    private $appendices      = ['death', 'meganess', 'awesomeness', 'worldliness', 'pinkness', 'doom', 'oblivion'];
    private $abstractNouns   = ['bravery', 'cowardice', 'emotion', 'not-there-ness', 'lethargy', 'campness', 'skill', 'incompetence', 'derision'];


    /**
     * @param \Randomiser|null $randomise
     */
    public function __construct(Randomiser $randomise = null)
    {
        $this->setRandomiser($randomise);
    }

    /**
     * @return bool|string
     */
    public function getVerb()
    {
        return $this->getWord($this->verbs, false);
    }

    /**
     * @return bool|string
     */
    public function getWeaponAdjective()
    {
        return $this->getWord($this->adjectives['weapon'], true);
    }

    /**
     * @return bool|string
     */
    public function getDodgeAdjective()
    {
        return $this->getWord($this->adjectives['dodge'], true);
    }

    /**
     * @return bool|string
     */
    public function getNoun()
    {
        return $this->getWord($this->nouns, false);
    }

    /**
     * @return bool|string
     */
    public function getAppendix()
    {
        return $this->getWord($this->appendices, false);
    }

    /**
     * @return bool|string
     */
    public function getAbstractNoun()
    {
        return $this->getWord($this->abstractNouns, false);
    }

    /**
     * @return bool|string
     */
    private function getWord(Array $wordSet, $definiteArticle = null)
    {
        $word = $this->getRandomiser()->getArrayItem($wordSet);
        if($definiteArticle) {
            $word = $this->appendDefiniteArticle($word);
        }
        return $word;
    }

    /**
     * @return string
     */
    private function appendDefiniteArticle($word)
    {
        $firstChar = strtolower(substr($word,0,1));
        if(in_array($firstChar, ['a', 'e', 'i', 'o', 'u'])) {
            $word = 'an ' . $word;
        } else {
            $word = 'a ' . $word;
        }
        return $word;
    }

    /**
     * @return void
     */
    public function setRandomiser(Randomiser $randomise = null)
    {
        $this->randomise = $randomise;
    }

    /**
     * @return \Randomiser
     */
    private function getRandomiser()
    {
        if(!$this->randomise instanceof Randomiser) {
            $this->randomise = new Randomiser();
        }
        return $this->randomise;
    }
}
