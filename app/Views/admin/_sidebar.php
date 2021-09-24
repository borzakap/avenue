<?php $current_url = current_url(true); ?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= route_to('/') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><?=lang('Sidebar.Dashboard') ?></span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Residential -->
    <li class="nav-item<?php if(in_array($current_url->getSegment(2), ['residentials', 'sections', 'layouts', 'flats', 'commerce'])) echo ' active' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResidentials" aria-expanded="true" aria-controls="collapseResidentials">
            <i class="fas fa-fw fa-building"></i>
            <span><?=lang('Sidebar.Residentials.BlockHeading') ?></span>
        </a>
        <div id="collapseResidentials" class="collapse<?php if(in_array($current_url->getSegment(2), ['residentials', 'sections', 'layouts', 'flats', 'commerce'])) echo ' show' ?>" aria-labelledby="headingResidentials" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item<?php if($current_url->setSilent()->getSegment(2) == 'residentials') echo ' active' ?>" href="<?= route_to('residentials') ?>"><?=lang('Sidebar.Residentials.Residentials') ?></a>
                <a class="collapse-item<?php if($current_url->setSilent()->getSegment(2) == 'sections') echo ' active' ?>" href="<?= route_to('sections') ?>"><?=lang('Sidebar.Residentials.Sections') ?></a>
                <a class="collapse-item<?php if($current_url->setSilent()->getSegment(2) == 'layouts') echo ' active' ?>" href="<?= route_to('layouts') ?>"><?=lang('Sidebar.Residentials.Layouts') ?></a>
                <a class="collapse-item<?php if($current_url->setSilent()->getSegment(2) == 'flats') echo ' active' ?>" href="<?= route_to('flats') ?>"><?=lang('Sidebar.Residentials.Flats') ?></a>
                <a class="collapse-item<?php if($current_url->setSilent()->getSegment(2) == 'commerce') echo ' active' ?>" href="<?= route_to('commerce') ?>"><?=lang('Sidebar.Residentials.Commerce') ?></a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages -->
    <li class="nav-item<?php if(in_array($current_url->getSegment(2), ['pages'])) echo ' active' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-language"></i>
            <span><?=lang('Sidebar.Pages.BlockHeading') ?></span>
        </a>
        <div id="collapsePages" class="collapse<?php if(in_array($current_url->getSegment(2), ['pages'])) echo ' show' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <a class="collapse-item<?php if($current_url->setSilent()->getSegment(4) == 'common') echo ' active' ?>" href="<?= route_to('page_update', 'common') ?>"><?=lang('Sidebar.Pages.Common') ?></a>
                <a class="collapse-item<?php if($current_url->setSilent()->getSegment(4) == 'home') echo ' active' ?>" href="<?= route_to('page_update', 'home') ?>"><?=lang('Sidebar.Pages.Home') ?></a>
                <a class="collapse-item<?php if($current_url->setSilent()->getSegment(4) == 'contact') echo ' active' ?>" href="<?= route_to('page_update', 'contact') ?>"><?=lang('Sidebar.Pages.Contact') ?></a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
