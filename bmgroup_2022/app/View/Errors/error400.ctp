<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
$this->layout = 'error';
?>
<div class="container padding-header">
    <div class="row justify-content-around">
      <div class="col-sm-10 margin-bottom-30">
        <div class="col-sm-12">
          <h2 class="h2blog my-3"><?php echo __($message); ?></h2>
        </div>

        <div class="col-sm-12">
          <p class="error">
            <strong><?php echo __d('cake', 'Error'); ?>: </strong>
            <?php printf(__('The requested address %s was not found on this server.'),"<strong>'{$url}'</strong>" ); ?>
            </p>
        </div>
      </div>
    </div>
</div>
<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>
