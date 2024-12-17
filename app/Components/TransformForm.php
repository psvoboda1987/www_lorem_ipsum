<?php

declare(strict_types=1);

namespace App\Components;

use App\Model\Strings;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;
use Webmozart\Assert\Assert;

final class TransformForm
{
    public function create(): Form
    {
        $form = new Form();

        $operations = [
            'upperCase' => 'upperCase',
            'lowerCase' => 'lowerCase',
            'camelCase' => 'camelCase',
            'capitalized' => 'capitalized',
            'reversed' => 'reversed',
            'underScored' => 'underScored',
            'hyphenized' => 'hyphenized',
            'truncated' => 'truncated',
        ];

        $form->addSelect('operation', 'Operation', $operations)
            ->setRequired()
            ->setPrompt('-vyberte-');

        $form->addSubmit('transform', 'Transform')
            ->setHtmlAttribute('class', 'bg-orange button white');

        $form->onSuccess[] = $this->transform(...);

        return $form;
    }

    private function transform(Form $form, ArrayHash $values): void
    {
        $operation = $values->offsetGet('operation');
        $presenter = $form->getPresenter();
        Assert::notNull($presenter);
        $length = $presenter->getComponent('generateForm')?->getValues()->offsetGet('length') ?? Strings::BASE_LOREM_LENGTH;
        $text = Strings::getLorem($length);

        $presenter->getTemplate()->transformed = match ($operation) {
            'upperCase' => Strings::toUpperCase($text),
            'lowerCase' => Strings::toLowerCase($text),
            'camelCase' => Strings::toCamelCase($text),
            'capitalized' => Strings::allWordsCapitalized($text),
            'reversed' => Strings::reverseText($text),
            'underScored' => Strings::toUnderscored($text),
            'hyphenized' => Strings::toHyphenized($text),
            'truncated' => Strings::truncate($text),
            default => $operation,
        };
    }
}