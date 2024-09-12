@props(['id', 'title', 'position'])
<div id="{{ $id ?? 'modal' }}" class="modal fade" tabindex="-1" aria-labelledby="{{ $title ?? 'Modal' }}" aria-hidden="true"
    data-bs-scroll="true">
    <div class="modal-dialog {{ $position ?? '' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $title ?? 'Modal' }}">{{ $title ?? 'Modal' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
