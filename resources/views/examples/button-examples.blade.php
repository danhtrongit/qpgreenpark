{{-- Button Component Examples --}}

<div class="p-8 space-y-8">
    <h1 class="text-3xl font-bold mb-8">Button Component Examples</h1>

    {{-- Basic Buttons --}}
    <section>
        <h2 class="text-2xl font-semibold mb-4">Basic Buttons</h2>
        <div class="space-x-4">
            <x-button>Default Button</x-button>
            <x-button type="secondary">Secondary Button</x-button>
        </div>
    </section>

    {{-- Button Sizes --}}
    <section>
        <h2 class="text-2xl font-semibold mb-4">Button Sizes</h2>
        <div class="space-x-4 flex items-center">
            <x-button size="md">Medium Button</x-button>
            <x-button size="lg">Large Button</x-button>
            <x-button size="xl">Extra Large Button</x-button>
        </div>
    </section>

    {{-- Button Types with Different Sizes --}}
    <section>
        <h2 class="text-2xl font-semibold mb-4">Primary Buttons (All Sizes)</h2>
        <div class="space-x-4 flex items-center">
            <x-button type="primary" size="md">Primary MD</x-button>
            <x-button type="primary" size="lg">Primary LG</x-button>
            <x-button type="primary" size="xl">Primary XL</x-button>
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-semibold mb-4">Secondary Buttons (All Sizes)</h2>
        <div class="space-x-4 flex items-center">
            <x-button type="secondary" size="md">Secondary MD</x-button>
            <x-button type="secondary" size="lg">Secondary LG</x-button>
            <x-button type="secondary" size="xl">Secondary XL</x-button>
        </div>
    </section>

    {{-- Link Buttons --}}
    <section>
        <h2 class="text-2xl font-semibold mb-4">Link Buttons</h2>
        <div class="space-x-4">
            <x-button url="https://example.com">Link Button (Same Tab)</x-button>
            <x-button url="https://example.com" :new-tab="true">Link Button (New Tab)</x-button>
        </div>
    </section>

    {{-- Link Buttons with Different Types and Sizes --}}
    <section>
        <h2 class="text-2xl font-semibold mb-4">Link Buttons - Various Combinations</h2>
        <div class="space-y-4">
            <div class="space-x-4">
                <x-button url="https://example.com" type="primary" size="lg">Primary Link LG</x-button>
                <x-button url="https://example.com" type="secondary" size="lg" :new-tab="true">Secondary Link LG (New Tab)</x-button>
            </div>
            <div class="space-x-4">
                <x-button url="https://example.com" type="primary" size="xl">Primary Link XL</x-button>
                <x-button url="https://example.com" type="secondary" size="xl" :new-tab="true">Secondary Link XL (New Tab)</x-button>
            </div>
        </div>
    </section>

    {{-- Buttons with Custom Attributes --}}
    <section>
        <h2 class="text-2xl font-semibold mb-4">Buttons with Custom Attributes</h2>
        <div class="space-x-4">
            <x-button onclick="alert('Button clicked!')" class="shadow-lg">Button with Click Handler</x-button>
            <x-button id="custom-button" data-custom="value">Button with Custom Attributes</x-button>
        </div>
    </section>
</div>
