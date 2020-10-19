@if (count($statuses) == 2)
    <?php $labels = ['success','danger']; ?>
@elseif (count($statuses) == 3)
    <?php $labels = ['info','success','danger']; ?>
@else
    <?php $labels = ['primary','info','success','danger','danger','warning','default','danger']; ?>
@endif
<span class="label label-{{ $labels[$status] }}">{{ $statuses[$status] }}</span>