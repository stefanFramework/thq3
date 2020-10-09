<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use Exception;
use Throwable;

class GenericException extends Exception
{
    protected const DEFAULT_CODE = 0;

    protected const MESSAGE_PREFIX = 'GenericException';

    protected string $defaultMessage = 'Default Message';

    protected array $context = [];

    public function __construct(?string $message = null, ?Throwable $previous = null)
    {
        parent::__construct($this->renderMessage($message), static::DEFAULT_CODE, $previous);

        $this->setPreviousMessage($previous);
    }

    protected function setPreviousMessage(?Throwable $previous = null): void
    {
        if (!is_null($previous)) {
            $this->context['previous'] = [
                'message' => $previous->getMessage(),
                'code' => $previous->getCode(),
                'class' => get_class($previous)
            ];
        }
    }

    public function renderMessage(?string $message): string
    {
        return static::MESSAGE_PREFIX . ' - ' . ($message ?: $this->getDefaultMessage());
    }

    public function setContext(array $context): self
    {
        $this->context = $context + $this->context;
        return $this;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    protected function getDefaultMessage(): string
    {
        return $this->defaultMessage;
    }
}
