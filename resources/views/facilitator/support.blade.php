<x-app-layout class="bg-neutral-100">

    <x-slot name="title">{{ __('Support Resources') }}</x-slot>

    <x-slot name="header">{{ __('Support Resources') }}</x-slot>

    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://join.slack.com/t/fuse-community/shared_invite/zt-g5fxd50j-GGO5kWbGfwvgUcfVDUNNjA">
                <h2 class="text-left text-xl m-0">
                    {{ __('FUSE Community Slack') }}
                </h2>
                <p>
                {{ __('Join to connect with other educators and reach a FUSE Team member 8am-4pm CST.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.zendesk.com/hc/en-us">
                <h2 class="text-left text-xl m-0">
                    {{ __('Knowledge Base (Zendesk)') }}
                </h2>
                <p>
                {{ __('Visit for in-depth information on Challenges, Re-supply, and more.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.zendesk.com/hc/en-us/categories/360001281572-Challenge-Guides">
                <h2 class="text-left text-xl m-0">
                    {{ __('Challenge Guides') }}
                </h2>
                <p>
                {{ __('In-depth information for each Challenge.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.zendesk.com/hc/en-us/articles/115001531131-How-To-Order-Supplies-and-Resupply">
                <h2 class="text-left text-xl m-0">
                    {{ __('Re-Supply Resources') }}
                </h2>
                <p>
                {{ __('Need materials? Check out how to re-order.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.zendesk.com/hc/en-us/categories/4410682893453-3D-Printing">
                <h2 class="text-left text-xl m-0">
                    {{ __('3D Printing') }}
                </h2>
                <p>
                {{ __('Custom videos for FUSE Facilitators troubleshooting printers.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://calendly.com/cortney-crego/fuse-support">
                <h2 class="text-left text-xl m-0">
                    {{ __('Schedule a Call') }}
                </h2>
                <p>
                {{ __('Meet one-on-one with our Studio Support Program Coordinator.') }}
                </p>
            </a>
        </li>
        <li class="bg-white rounded-lg border shadow-lg px-8 py-12 list-none m-0">
            <a target="_blank" href="https://fusestudio.zendesk.com/hc/en-us/articles/360020869552-Contact-FUSE">
                <h2 class="text-left text-xl m-0">
                    {{ __('Find us on Slack') }}
                </h2>
                <p>
                {{ __('Reach someone during school hours on Community Slack.') }}
                </p>
            </a>
        </li>
    </ul>

</x-app-layout>