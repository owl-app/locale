<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Owl\Component\Locale\Provider;

use Owl\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class LocaleProvider implements LocaleProviderInterface
{
    /** @var RepositoryInterface */
    private $localeRepository;

    /** @var string */
    private $defaultLocaleCode;

    public function __construct(RepositoryInterface $localeRepository, string $defaultLocaleCode)
    {
        $this->localeRepository = $localeRepository;
        $this->defaultLocaleCode = $defaultLocaleCode;
    }

    public function getAvailableLocalesCodes(): array
    {
        $locales = $this->localeRepository->findAll();

        return array_map(
            function (LocaleInterface $locale) {
                return (string) $locale->getCode();
            },
            $locales,
        );
    }

    public function getDefaultLocaleCode(): string
    {
        return $this->defaultLocaleCode;
    }
}
