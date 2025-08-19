<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class Webhook
{
    private string $webhookUrl;

    public function __construct(string $webhookUrl)
    {
        $this->setWebhookUrl($webhookUrl);
    }

    /**
     * @return string
     */
    public function getWebhookUrl(): string
    {
        return $this->webhookUrl;
    }

    /**
     * @param string $webhookUrl
     * @throws \InvalidArgumentException
     */
    public function setWebhookUrl(string $webhookUrl): void
    {
        if (strlen($webhookUrl) > 200) {
            throw new \InvalidArgumentException('O webhookUrl não pode ter mais de 200 caracteres.');
        }

        if (!filter_var($webhookUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('O webhookUrl deve ser uma URL válida.');
        }

        $this->webhookUrl = $webhookUrl;
    }

    /**
     * Retorna os dados do webhook como array associativo
     *
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'webhookUrl' => $this->webhookUrl,
        ];
    }
}
