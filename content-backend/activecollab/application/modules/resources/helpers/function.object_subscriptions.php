<?php

  /**
   * object_subscriptions helper
   *
   * @package activeCollab.modules.resources
   * @subpackage helpers
   */
  
  /**
   * Render object subscribers
   *
   * @param array $params
   * @param Smarty $smarty
   * @return string
   */
  function smarty_function_object_subscriptions($params, &$smarty) {
    $object = array_var($params, 'object');
    if(!instance_of($object, 'ProjectObject')) {
      return new InvalidParamError('object', $object, '$object is expected to be an instance of ProjectObject class', true);
    } // if
    
    js_assign('max_subscribers_count', MAX_SUBSCRIBERS_COUNT);
    require_once SYSTEM_MODULE_PATH . '/helpers/function.user_link.php';
    
    $subscribers = $object->getSubscribers();
    if (count($subscribers) > MAX_SUBSCRIBERS_COUNT) {
      $smarty->assign(array(
        '_object_subscriptions_list_subscribers' => false,
        '_object_subscriptions_object' => $object,
        '_object_subscriptions_subscribers_count' => count($subscribers),
        '_object_subscription_brief' => array_var($params, 'brief', false),
        '_object_subscriptions_popup_url' => assemble_url('object_subscribers_widget', array('object_id' => $object->getId(), )),
      ));
    } else {
      $links = null;
      if(is_foreachable($subscribers)) {
        $links = array();
        foreach($subscribers as $subscriber) {
          $links[] = smarty_function_user_link(array('user' => $subscriber), $smarty);
        } // foreach
      } // if
        
      $smarty->assign(array(
        '_object_subscriptions_list_subscribers' => true,
        '_object_subscriptions' => $subscribers,
        '_object_subscriptions_object' => $object,
        '_object_subscription_links' => $links,
        '_object_subscription_brief' => array_var($params, 'brief', false),
        '_object_subscriptions_popup_url' => assemble_url('object_subscribers_widget', array('object_id' => $object->getId(), )),
      ));      
    } // if
    
    
    return $smarty->fetch(get_template_path('_object_subscriptions', 'subscriptions', RESOURCES_MODULE));
  } // smarty_function_object_subscriptions

?>