<?php

namespace Ruon\Bundle\RepairBundle\Block\Service;

use Symfony\Component\HttpFoundation\Response;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

/**
 * Description of MainMenuBlockServicew
 *
 * @author Goorus
 */
class MainMenuBlockService extends \Sonata\BlockBundle\Block\BaseBlockService
{

    public function getDefaultSettings()
    {
        return array(
            'url'     => false,
            'title'   => 'Insert the rss title'
        );
    }

    public function buildEditForm(FormMapper $form, BlockInterface $block)
    {
        $form->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('url', 'url', array('required' => false)),
                array('title', 'text', array('required' => false)),
            )
        ));
    }

    public function execute(BlockInterface $block, Response $response = null)
    {
//        // merge settings
//        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());
//
//        $feeds = false;
//        if ($settings['url']) {
//            $options = array(
//                'http' => array(
//                    'user_agent' => 'Sonata/RSS Reader',
//                    'timeout' => 2,
//                )
//            );
//
//            // retrieve contents with a specific stream context to avoid php errors
//            $content = @file_get_contents($settings['url'], false, stream_context_create($options));
//
//            if ($content) {
//                // generate a simple xml element
//                try {
//                    $feeds = new \SimpleXMLElement($content);
//                    $feeds = $feeds->channel->item;
//                } catch(\Exception $e) {
//                    // silently fail error
//                }
//            }
//        }

        return $this->renderResponse(
            'RuonRepairBundle:Block:block_main_menu.html.twig',
            array(), 
            $response
        );
    }

    public function validateBlock(ErrorElement $errorElement,
        BlockInterface $block)
    {
        $errorElement
            ->with('settings.url')
                ->assertNotNull(array())
                ->assertNotBlank()
            ->end()
            ->with('settings.title')
                ->assertNotNull(array())
                ->assertNotBlank()
                ->assertMaxLength(array('limit' => 50))
            ->end();
    }

}
