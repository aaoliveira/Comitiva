<?php
$eventLink = Router::url("/divulgacao/{$event['Event']['alias']}", true);
?>
<div class="row-fluid">
	<ul class="nav nav-tabs nav-stacked span2">
		<li><?php echo $this->Html->link(__('Alterar Evento'), array('action' => 'edit', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Ver inscrições'), array('controller' => 'subscriptions', 'action' => 'index', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Nova Inscrição'), array('controller' => 'subscriptions', 'action' => 'add', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Enviar aviso aos inscritos'), array('controller' => 'events', 'action' => 'sendAdvertise', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Remover Evento'), array('action' => 'delete', $event['Event']['id']), null, sprintf(__('Deseja realmente excluir o evento "%s"?'), $event['Event']['title'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Eventos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Evento'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Adicionar Sub-evento'), array('controller' => 'events', 'action' => 'add'));?> </li>
	</ul>
	<div class="events view span10">
		<div class="page-header">
			<h1>
				<?php echo $event['Event']['title'];?>
				<small><?php echo $event['Event']['lead'];?></small>
			</h1>
			<strong>Link para divulgação: <?php echo $this->Html->link($eventLink, $eventLink)?></strong>
		</div>
		<div class="well">
			<?php echo $event['Event']['description']; ?>
		</div>

		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Inscritos'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($event['Event']['subscription_count'], array('controller' => 'subscriptions', 'action' => 'index', $event['Event']['id'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Macro Evento'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($event['ParentEvent']['title'], array('controller' => 'events', 'action' => 'view', $event['ParentEvent']['id'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Gratuito'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $event['Event']['free'] == true ? __('Sim') : __('Não'); ?>
				&nbsp;
			</dd>
		</dl>

		<?php if (!empty($event['EventDate'])):?>
			<h3><?php echo __('Datas');?></h3>

			<table class="table table-striped table-bordered table-condensed">
			<tr>
				<th><?php echo __('Legenda'); ?></th>
				<th><?php echo __('Data'); ?></th>
			</tr>
			<?php
				$i = 0;
				foreach ($event['EventDate'] as $eventDate):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
				?>
				<tr<?php echo $class;?>>
					<td><?php echo $eventDate['desc'];?></td>
					<td><?php echo $this->Locale->dateTime($eventDate['date']);?></td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>

		<?php if (!empty($event['EventPrice'])):?>
			<h3><?php echo __('Valores');?></h3>
			<table  class="table table-striped table-bordered table-condensed">
			<tr>
				<th><?php echo __('Observação');?></th>
				<th><?php echo __('Valor'); ?></th>
				<th><?php echo __('Período'); ?></th>
			</tr>
			<?php
				$i = 0;
				foreach ($event['EventPrice'] as $eventPrice):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
				?>
				<tr<?php echo $class;?>>
					<td><?php echo $eventPrice['observation'];?></td>
					<td><?php echo $this->Locale->currency($eventPrice['price']);?></td>
					<td><?php echo __('entre'), ' ', $this->Locale->date($eventPrice['start_date']), ' ', __('e'), ' ',$this->Locale->date($eventPrice['final_date']);?></td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>

		<?php if (!empty($event['ChildEvent'])):?>
			<h3><?php echo __('Sub-eventos');?></h3>
			<table class="table table-striped table-bordered table-condensed">
			<tr>
				<th><?php echo __('Nome'); ?></th>
				<th><?php echo __('Descrição'); ?></th>
				<th><?php echo __('Gratuito'); ?></th>
				<th class="actions"><?php echo __('Ações');?></th>
			</tr>
			<?php
				$i = 0;
				foreach ($event['ChildEvent'] as $childEvent):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
				?>
				<tr<?php echo $class;?>>
					<td><?php echo $childEvent['title'];?></td>
					<td><?php echo $childEvent['description'];?></td>
					<td><?php $childEvent['free'] == TRUE ? __('Sim') : __('Não');?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('Visualizar'), array('controller' => 'events', 'action' => 'view', $childEvent['id'])); ?>
						<?php echo $this->Html->link(__('Alterar'), array('controller' => 'events', 'action' => 'edit', $childEvent['id'])); ?>
						<?php echo $this->Html->link(__('Remover'), array('controller' => 'events', 'action' => 'delete', $childEvent['id']), null, sprintf(__('Deseja realmente excluir o evento \'%s\'?'), $childEvent['title'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>
