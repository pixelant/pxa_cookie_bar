<?php

declare(strict_types=1);

namespace Pixelant\PxaCookieBar\Middleware;

use Pixelant\PxaCookieBar\Domain\Model\CookieWarning;
use Pixelant\PxaCookieBar\Domain\Repository\CookieWarningRepository;
use Pixelant\PxaCookieBar\Utility\CookieUtility;
use Pixelant\PxaCookieBar\Utility\RegistryHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\FrontendEditing\Hook\FrontendEditingInitializationHook;
use TYPO3\CMS\FrontendEditing\Service\AccessService;

class CookieBar implements MiddlewareInterface
{
    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $registryHandler = GeneralUtility::makeInstance(RegistryHandler::class);
        $settings = $registryHandler->getSavedSettings();

        if (!isset($_COOKIE['pxa_cookie_warning']) && $settings['activeConsent']) {
            if (session_id()) {
                setcookie(session_name(), session_id(), time() - 60 * 60 * 24, '/');
                session_unset();
                session_destroy();
            }

            CookieUtility::removeAllCookies();
        }

        return $handler->handle($request);
    }

    /**
     * @param int $pid
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function getCookieWarning(int $pid): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_pxacookiebar_domain_model_cookiewarning');

        return $queryBuilder
            ->select('*')
            ->from('tx_pxacookiebar_domain_model_cookiewarning')
            ->where(
                $queryBuilder->expr()->eq(
                    'pid',
                    $queryBuilder->createNamedParameter($pid)
                )
            )
            ->setMaxResults(1)
            ->execute()
            ->fetch();
    }
}
