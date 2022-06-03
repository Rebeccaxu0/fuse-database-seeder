@push('scripts')
<script>
    function setArtifactFormType(type) {
            if (type == 'save') {
                    document.getElementById('save_type').checked = true;
                    document.getElementById('complete_type').checked = false;
                }
            else if (type == 'complete') {
                    document.getElementById('save_type').checked = false;
                    document.getElementById('complete_type').checked = true;
                }
        }
    const saveBtnTop = document.getElementById('save-btn-top');
    const saveBtn = document.getElementById('save-btn');
    const completeBtnTop = document.getElementById('complete-btn-top');
    const completeBtn = document.getElementById('complete-btn');
    saveBtnTop.addEventListener('click', function() { setArtifactFormType('save')}, false);
    completeBtnTop.addEventListener('click', function() { setArtifactFormType('complete')}, false);
    saveBtn.addEventListener('click', function() { setArtifactFormType('save')}, false);
    completeBtn.addEventListener('click', function() { setArtifactFormType('complete')}, false);
</script>
@endpush

<x-app-layout>
    <x-slot name="title">{{ __('My Idea') }} | {{ $idea->name }}</x-slot>

    <x-slot name="header">{{ __('My Idea') }} | <span class="font-light">{{ $idea->name }}</span></x-slot>

    <div x-data="{ saveCompleteFormOpen: false}" >

    <div class="border sm:flex">
        <div class="p-8 flex-1">
            <div>{{ __('The Idea') }}
                <livewire:student.idea-edit :ideaId="$idea->id" />
            </div>
            <div>
                {{ $idea->body }}
            </div>
            <div>
                <span>{{ __('Inspired by: :inspiration', ['inspiration' => $idea->inspirationListToStr()]) }}</span>
            </div>
            <div>
                <span>{{ __('Team: :team', ['team' => $idea->usersListToStr()]) }}</span>
            </div>
        </div>
        <div class="flex-1 bg-fuse-teal-dk text-white">
            preview Image
        </div>
    </div>
                <a name="save-complete"></a>
                    <a href="#save-complete"
                       id='save-btn-top'
                       class="btn"
                       @click="saveCompleteFormOpen = true"
                       >{{ __('Save') }}</a>
                    <a href="#save-complete"
                       id='complete-btn-top'
                       class="btn"
                       @click="saveCompleteFormOpen = true"
                       >{{ __('Complete') }}</a>
                    <div x-show="saveCompleteFormOpen"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 scale-50"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-50"
                         ><livewire:level-save-or-complete-form :lid="$idea->levels->first()->id"/></div>

    <footer id="level-footer" class="z-10 fixed bottom-0 inset-x-0 h-[75px] bg-fuse-teal bg-opacity-90 text-white uppercase">
        <div class="pt-4 pb-8 flex">
            <div class="flex-1 flex">
                <a href="#save-complete"
                   id="save-btn"
                   class="btn"
                   @click="saveCompleteFormOpen = true"
                   >{{ __('Save') }}</a>
                <a href="#save-complete"
                   id="complete-btn"
                   class="btn"
                   @click="saveCompleteFormOpen = true"
                   >{{ __('Complete') }}</a>
            </div>
        </div>
    </footer>
</x-app-layout>

