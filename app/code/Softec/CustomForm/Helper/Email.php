<?php


namespace Softec\CustomForm\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
/**
 * Class Email
 *
 * @package Softec\CustomForm\Helper
 */
class Email extends AbstractHelper
{

	protected $inlineTranslation;
    protected $escaper;
    protected $transportBuilder;
    protected $logger;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $context->getLogger();
    }

    public function sendEmailHome($post)
    {   



        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('WEB GamaLeasing'),
                'email' => $this->escaper->escapeHtml('no-reply@corp.gamaleasing.fullkom.com'),
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('email_home')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'rut_empresa'  => $post['rut_empresa'],
                    'razon_social'  => $post['razon_social'],
                    'tipo_vehiculo'  => $post['tipo_vehiculo'],
                    'unidades'  => $post['unidades'],
                    'industria'  => $post['industria'],
                    'nombre'  => $post['nombre'],
                    'rut_contacto'  => $post['rut_contacto'],
                    'email'  => $post['email'],
                    'telefono'  => $post['telefono'],
                ])
                ->setFrom($sender)
                ->addTo('contacto@gamaleasing.cl')
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }

    public function sendEmailDenuncia($post)
    {   



        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('WEB GamaLeasing'),
                'email' => $this->escaper->escapeHtml('no-reply@corp.gamaleasing.fullkom.com'),
            ];
            $tipo_denuncia = '';
            foreach ($post['tipo_denuncia'] as $key => $value) {
                $tipo_denuncia .='-'.$value;
            }
            $archivo = '';
            $archivo = $post['file'];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('email_denuncia')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'rut'  => $post['rut'],
                    'nombre_completo'  => $post['nombre_completo'],
                    'correo_electronico'  => $post['correo_electronico'],
                    'telefono_contacto'  => $post['telefono_contacto'],
                    'tipo_personal'  => $post['tipo_personal'],
                    'conocimiento'  => $post['conocimiento'],
                    'detalle'  => $post['detalle'],
                    'otros_asuntos'  => $post['otros_asuntos'],
                    'tipo_denuncia'  => $tipo_denuncia,
                    'archivo'  => $archivo
                ])
                ->setFrom($sender)
                ->addTo('denuncias@gamaleasing.cl')
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();

        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }

    public function sendEmailContacto($post)
    {   



        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('WEB GamaLeasing'),
                'email' => $this->escaper->escapeHtml('no-reply@corp.gamaleasing.fullkom.com'),
            ];

            $transport = $this->transportBuilder
                ->setTemplateIdentifier('email_contacto')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'nombre'  => $post['nombre'],
                    'apellido'  => $post['apellido'],
                    'telefono'  => $post['telefono'],
                    'correo'  => $post['correo'],
                    'comentario'  => $post['comentario'],
                    'terminos'  => $post['terminos']
                ])
                ->setFrom($sender)
                ->addTo('contacto@gamaleasing.cl')
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();

        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }

}

