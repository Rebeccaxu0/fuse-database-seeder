<x-app-layout class="bg-neutral-100">

    <x-slot name="title">{{ __('Support Resources') }}</x-slot>

    <x-slot name="header">{{ __('Support Resources') }}</x-slot>

    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://join.slack.com/t/fuse-community/shared_invite/zt-g5fxd50j-GGO5kWbGfwvgUcfVDUNNjA">
                <h2 class="text-left text-xl m-0">
                    {{ __('FUSE Community Slack') }}
                </h2>
                <p class="m-0">
                {{ __('Join to connect with other educators and reach a FUSE Team member 8am-4pm CST.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.zendesk.com/hc/en-us">
                <h2 class="text-left text-xl m-0">
                    {{ __('Knowledge Base (Zendesk)') }}
                </h2>
                <p class="m-0">
                {{ __('Visit for in-depth information on best practices, kits, and more.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.zendesk.com/hc/en-us/categories/360001281572-Challenge-Guides">
                <h2 class="text-left text-xl m-0">
                    {{ __('Challenge Guides') }}
                </h2>
                <p class="m-0">
                {{ __('In-depth information for each Challenge.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.zendesk.com/hc/en-us/articles/115001531131-How-To-Order-Supplies-and-Resupply">
                <h2 class="text-left text-xl m-0">
                    {{ __('Re-Supply Resources') }}
                </h2>
                <p class="m-0">
                {{ __('Need materials? Check out how to re-order.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.zendesk.com/hc/en-us/categories/4410682893453-3D-Printing">
                <h2 class="text-left text-xl m-0">
                    {{ __('3D Printing') }}
                </h2>
                <p class="m-0">
                {{ __('In-depth information for FUSE Facilitators troubleshooting printers.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://calendly.com/cortney-crego/fuse-support">
                <h2 class="text-left text-xl m-0">
                    {{ __('Schedule a Call') }}
                </h2>
                <p class="m-0">
                {{ __('Meet one-on-one with our Studio Support Program Coordinator.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.typeform.com/to/iN1PRcCG">
                <h2 class="text-left text-xl m-0">
                    {{ __('Studio Requests') }}
                </h2>
                <p class="m-0">
                {{ __('Request additional studios or studio removal.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="mailto:help@fusestudio.net">
                <h2 class="text-left text-xl m-0">
                    {{ __('Email Us') }}
                </h2>
                <p class="m-0">
                {{ __('Email us directly at help@fusestudio.net') }}
                </p>
            </a>
        </li>
    </ul>

</x-app-layout>