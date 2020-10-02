<?php

declare(strict_types=1);

namespace App\Domain\Integrations;

use Illuminate\Support\Facades\Log;
use Throwable;

use App\Domain\ApiClient\Client;
use App\Domain\ApiClient\ClientConfig;
use App\Domain\ApiClient\ClientHeaders;
use App\Domain\ApiClient\Exceptions\HttpException;


class StatusReportApiClient
{
    private const DEPLOYMENTS_PATH = '/apis/apps/v1/namespaces/teams/deployments';

    public function getClient(): Client
    {
        /** @var ?Client $client */
        static $client = null;

        if (is_null($client)) {
            $clientHeaders = new ClientHeaders();
            $clientHeaders->authorization($this->getAuthorization());

            $clientConfig = new ClientConfig([
                'base_uri' => $this->getBaseUri(),
                'headers' => $clientHeaders
            ]);

            $client = new Client($clientConfig);
        }

        return $client;
    }

    public function getDeploymentsInfo()
    {
        try {
            $data = $this->getClient()->get(self::DEPLOYMENTS_PATH);
            return $data->items;
        } catch (HttpException $ex) {
            // Do something
            Log::info('error', ['ex' => $ex]);
            throw $ex;
        } catch (Throwable $ex) {
            Log::info('error', ['ex' => $ex]);
            throw $ex;
        }
    }

    private function getAuthorization(): string
    {
        return 'Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6ImVGSlE0RE9icV9uV2ptNzFQcGU1SmN5blZtT0psdW03amdXX0ZWUkhYLWsifQ.eyJpc3MiOiJrdWJlcm5ldGVzL3NlcnZpY2VhY2NvdW50Iiwia3ViZXJuZXRlcy5pby9zZXJ2aWNlYWNjb3VudC9uYW1lc3BhY2UiOiJrdWJlLXV0aWxzIiwia3ViZXJuZXRlcy5pby9zZXJ2aWNlYWNjb3VudC9zZWNyZXQubmFtZSI6InRyb2NhdGFsb2dvLXNlcnZpY2UtYWNjb3VudC10b2tlbi0yMmtnbCIsImt1YmVybmV0ZXMuaW8vc2VydmljZWFjY291bnQvc2VydmljZS1hY2NvdW50Lm5hbWUiOiJ0cm9jYXRhbG9nby1zZXJ2aWNlLWFjY291bnQiLCJrdWJlcm5ldGVzLmlvL3NlcnZpY2VhY2NvdW50L3NlcnZpY2UtYWNjb3VudC51aWQiOiI0Yjk0MDk4OS00MzM2LTQzMGUtOGZkOS0wOTdiNjVlMTRjOWUiLCJzdWIiOiJzeXN0ZW06c2VydmljZWFjY291bnQ6a3ViZS11dGlsczp0cm9jYXRhbG9nby1zZXJ2aWNlLWFjY291bnQifQ.sEaQGtpYbYNb59CqKDKDaA46-APO1_PjeuvXzyBFZIXouH17ALLTidCa8ChbV3R2yvyRuXgUP9IGT4Yja69RxqQYbUJVAS13pGnyyH1Z2LG8_34OWEXWtviS7xpFe-n8ns9Vs2OiEzWIB5SKy39_P7f4mbIjMbC7WbIXUG7CKFfLQSvNXlKjMgOx1amInuJim_Jd5xKaP40MjN54MUteNrocyJ0ryERbduAnoOCpxxv2YTsArJElrP1Pvqeaas-4lNnpA9G1pEvHFDSi-5LQpNPxw4hRpCSQlLHPG0tL7TLhijP7Xz0qR-v9KdVvyiRljcK9dg3ALr3wwePUJETGwA';
    }

    private function getBaseUri(): string
    {
        return 'https://fc8f4b59325c35e003e985879e2af35d.yl4.us-east-1.eks.amazonaws.com';
    }
}
