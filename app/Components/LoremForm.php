<?php

declare(strict_types=1);

namespace App\Components;

use App\Model\Strings;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;
use Webmozart\Assert\Assert;

final class LoremForm
{
    public function create(): Form
    {
        $form = new Form();

        $form->addInteger('length', 'Length')
            ->setRequired()
            ->setDefaultValue(Strings::BASE_LOREM_LENGTH);

        $form->addSubmit('generate', 'Generate')
            ->setHtmlAttribute('class', 'bg-green button white');

        $form->onSuccess[] = $this->generate(...);

        return $form;
    }

    private function generate(Form $form, ArrayHash $values): void
    {
        $presenter = $form->getPresenter();
        Assert::notNull($presenter);
        $presenter->getTemplate()->lorem = Strings::getLorem($values->length);
    }
}