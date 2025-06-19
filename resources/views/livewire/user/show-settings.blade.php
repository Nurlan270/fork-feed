@use(Mcamara\LaravelLocalization\Facades\LaravelLocalization)
<div class="mx-auto">
    <!-- Profile Images Section -->
    <div class="rounded-xl p-6 mb-6 shadow-lg bg-white border border-gray-200">
        <h3 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
            </svg>
            {{ __('settings.profile_images.title') }}
        </h3>

        <!-- Banner Upload -->
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2 text-gray-700">
                {{ __('settings.profile_images.banner.label') }}
            </label>
            <div class="relative h-40 md:h-48 rounded-lg overflow-hidden border-2 border-gray-200 group cursor-pointer">
                <!-- Current Banner -->

                <div class="absolute inset-0">
                    <img src="
                        @if($form->banner && Str::contains($form->banner->getMimeType(), ['image/jpg', 'image/jpeg', 'image/png']))
                            {{ $form->banner->temporaryUrl() }}
                        @else
                            {{ $form->user->banner }}
                        @endif"
                         alt="{{ __('settings.profile_images.banner.alt') }}"
                         class="w-full h-full object-cover">
                </div>

                <!-- Hover Overlay -->
                <div
                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <div class="text-center text-white">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-2">
                            <path
                                d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/>
                            <circle cx="12" cy="13" r="3"/>
                        </svg>
                        <p class="text-sm font-medium">
                            {{ __('settings.profile_images.banner.upload_text') }}
                        </p>
                        <p class="text-xs opacity-80">
                            {{ __('settings.profile_images.banner.file_requirements') }}
                        </p>
                    </div>
                </div>

                <!-- Invisible File Input -->
                <input wire:model="form.banner" type="file" accept="image/jpg, image/jpeg, image/png"
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            </div>
        </div>
        @error('form.banner')
        <span class="text-red-500 text-base">{{ $message }}</span>
        @enderror


        <!-- Avatar Upload -->
        <div class="mt-3">
            <label class="block text-sm font-medium mb-2 text-gray-700">
                {{ __('settings.profile_images.avatar.label') }}
            </label>
            <div class="flex items-center gap-4">
                <div class="relative group cursor-pointer">
                    <!-- Current Avatar -->
                    <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-gray-200">
                        <img src="
                            @if($form->avatar && Str::contains($form->avatar->getMimeType(), ['image/jpg', 'image/jpeg', 'image/png']))
                                {{ $form->avatar->temporaryUrl() }}
                            @else
                                {{ $form->user->avatar }}
                            @endif"
                             alt="{{ __('settings.profile_images.avatar.alt') }}"
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Hover Overlay -->
                    <div
                        class="absolute inset-0 bg-black/50 bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path>
                            <circle cx="12" cy="13" r="3"></circle>
                        </svg>
                    </div>

                    <input wire:model="form.avatar" type="file" accept="image/jpg, image/jpeg, image/png"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('settings.profile_images.avatar.update_text') }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ __('settings.profile_images.avatar.file_requirements') }}
                    </p>
                </div>
            </div>
            @error('form.avatar')
            <span class="text-red-500 text-base">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Left Column: Profile Information -->
        <div class="rounded-xl p-6 shadow-lg bg-white border border-gray-200">
            <h3 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-900">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                {{ __('settings.profile_information.title') }}
            </h3>

            <div class="space-y-6">
                <!-- Name Field -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">
                        {{ __('settings.profile_information.name.label') }}
                    </label>
                    <input type="text"
                           wire:model.live="form.name"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    @error('form.name')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Username Field -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">
                        {{ __('settings.profile_information.username.label') }}
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25"/>
                            </svg>
                        </span>
                        <input type="text"
                               wire:model.live="form.username"
                               class="w-full pl-8 pr-4 py-3 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                    @error('form.username')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Right Column: Security -->
        <div class="rounded-xl p-6 shadow-lg bg-white border border-gray-200">
            <h3 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-900">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <circle cx="12" cy="16" r="1"></circle>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                {{ __('settings.security.title') }}
            </h3>

            <div class="space-y-6">
                <!-- Current Password Field -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">
                        {{ __('settings.security.current_password.label') }}
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="current-password"
                               wire:model.live="form.current_password"
                               placeholder="{{ __('settings.security.current_password.placeholder') }}"
                               class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('form.current_password')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- New Password Field -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">
                        {{ __('settings.security.new_password.label') }}
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="new-password"
                               wire:model.live="form.password"
                               placeholder="{{ __('settings.security.new_password.placeholder') }}"
                               class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('form.password')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">
                        {{ __('settings.security.confirm_password.label') }}
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="confirm-password"
                               wire:model.live="form.password_confirmation"
                               placeholder="{{ __('settings.security.confirm_password.placeholder') }}"
                               class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('form.password_confirmation')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preferences Section -->
    <div class="rounded-xl p-6 mb-8 shadow-lg bg-white border border-gray-200">
        <h3 class="text-xl font-semibold mb-6 flex items-center gap-2 text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/>
            </svg>
            {{ __('settings.preferences.title') }}
        </h3>

        <div class="space-y-6">
            <!-- Language/Locale Switcher -->
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-blue-50">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" class="text-blue-600">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">
                            {{ __('settings.preferences.language.title') }}
                        </h4>
                        <p class="text-sm text-gray-500 hidden md:block">
                            {{ __('settings.preferences.language.description') }}
                        </p>
                    </div>
                </div>

                <div class="relative">
                    <button id="states-button" data-dropdown-toggle="dropdown-states"
                            class="shrink-0 z-10 inline-flex items-center py-2.5 px-6 text-sm font-medium text-center rounded-lg text-gray-600 border border-gray-300 hover:bg-gray-100 transition-colors cursor-pointer"
                            type="button">
                        {{ LaravelLocalization::getCurrentLocaleNative() }}
                    </button>
                    <div id="dropdown-states"
                         class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 border border-gray-100">
                        <ul class="py-2 text-sm text-gray-600" aria-labelledby="states-button">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                @if($localeCode !== LaravelLocalization::getCurrentLocale())
                                    <li>
                                        <a rel="alternate"
                                           hreflang="{{ $localeCode }}"
                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'settings', forceDefaultLocation: true) }}"
                                           class="inline-flex w-full px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
                                            <div class="inline-flex items-center">
                                                {{ $properties['native'] }}
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end">
        <button wire:click="save"
                class="flex items-center gap-2 px-6 py-3 rounded-lg font-medium text-white bg-primary-600 hover:bg-primary-700 transition-all cursor-pointer">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                <polyline points="17,21 17,13 7,13 7,21"></polyline>
                <polyline points="7,3 7,8 15,8"></polyline>
            </svg>
            {{ __('settings.save_changes') }}
        </button>
    </div>
</div>
