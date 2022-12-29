<?php 
	$this->Paginator->options($options);
	$paginatorParams = $this->paginator->params(); 
    $paginatorModulus = 10;
    // Bootstrap 3
?>
<p class="noprint text-muted font-13"><?php echo sprintf(__("Mostrando %d registros %d de %d - Página %d / %d"),$paginatorParams['limit'],$paginatorParams['current'],$paginatorParams['count'],$paginatorParams['page'],$paginatorParams['pageCount']); ?></p>
<ul class="pagination justify-content-center">
<?php
    echo $this->Paginator->prev('<i class="fa fa-angle-double-left"></i>', array('escape' => false, 'tag' => 'li', 'class'=>'page-item', ' class'=>'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', ' class' =>'page-link'));
    echo $this->Paginator->prev('<i class="fa fa-angle-left"></i>', array('escape' => false, 'tag' => 'li', 'class'=>'page-item', ' class'=>'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', ' class' =>'page-link'));
    echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'class'=>'page-item',  'currentClass' => 'active', ' class'=>'page-link', 'currentClass'=>'page-link active'));
    echo $this->Paginator->next('<i class="fa fa-angle-right"></i>', array('escape' => false, 'tag' => 'li', 'class'=>'page-item', ' class'=>'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', 'currentClass'=>'page-link', ' class' =>'page-link'));
    echo $this->Paginator->last('<i class="fa fa-angle-double-right"></i>', array('escape' => false, 'tag' => 'li', 'class'=>'page-item', ' class'=>'page-link'), null, array('class' => 'disabled page-item', 'tag' => 'li', 'disabledTag' => 'a', ' class' =>'page-link'));
?> </ul> 