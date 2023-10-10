<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __("Hisobni O'chirish") }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Hisobingiz o'chirilgandan so'ng, uning barcha resurslari va ma'lumotlari butunlay o'chiriladi. Hisobingizni o'chirishdan oldin, saqlamoqchi bo'lgan har qanday  ma'lumotni yuklab oling.") }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __("Hisobni O'chirish") }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Hisobingizni oʻchirib tashlamoqchimisiz?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Hisobingiz o'chirilgandan so'ng, uning barcha resurslari va ma'lumotlari butunlay o'chiriladi. Hisobingizni o'chirishdan oldin, saqlamoqchi bo'lgan har qanday  ma'lumotni yuklab oling.") }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Parol') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __("To'xtatish") }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __("Hisobni O'chirish") }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>


    <x-modal name="confirm-user-logout" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('logout') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Hisobingizdan chiqmoqchimisiz?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Hisobingizdan chiqaningizdan so'ng qayta kirish uchun elekron pochta va parolni terishingiz kerak.") }}
            </p>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __("To'xtatish") }}
                </x-secondary-button>

                <x-danger-button  class="ml-3"
                                  onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Chiqish') }}
                </x-danger-button >

            </div>
        </form>
    </x-modal>
</section>
