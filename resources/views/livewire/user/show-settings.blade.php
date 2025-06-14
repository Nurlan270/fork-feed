<div class="mx-auto">
    <!-- Profile Images Section -->
    <div class="rounded-xl p-6 mb-6 shadow-lg bg-white border border-gray-200">
        <h3 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            Profile Images
        </h3>

        <!-- Banner Upload -->
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2 text-gray-700">
                Banner Image
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
                         alt="Current banner"
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
                            Upload new banner
                        </p>
                        <p class="text-xs opacity-80">
                            JPG, JPEG or PNG. Max size 5MB
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
                Profile Picture
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
                             alt="Current avatar"
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
                        Update your avatar
                    </p>
                    <p class="text-xs text-gray-500">
                        JPG, JPEG or PNG. Max size 5MB
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
                Profile Information
            </h3>

            <div class="space-y-6">
                <!-- Name Field -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">
                        Display Name
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
                        Username
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
                Security
            </h3>

            <div class="space-y-6">
                <!-- Current Password Field -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">
                        Current Password
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="current-password"
                               wire:model.live="form.current_password"
                               placeholder="Enter current password"
                               class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('form.current_password')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- New Password Field -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">
                        New Password
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="new-password"
                               wire:model.live="form.password"
                               placeholder="Enter new password"
                               class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('form.password')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="confirm-password"
                               wire:model.live="form.password_confirmation"
                               placeholder="Confirm new password"
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
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
            Preferences
        </h3>

        <div class="space-y-6">
            <!-- Theme Toggle -->
            <div class="flex items-center justify-between py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-yellow-50">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" class="text-yellow-600">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">
                            Theme
                        </h4>
                        <p class="text-sm text-gray-500">
                            Choose your preferred theme
                        </p>
                    </div>
                </div>

                <button id="theme-toggle" type="button"
                        class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <span
                        class="inline-block h-4 w-4 transform rounded-full bg-white shadow-lg transition-transform translate-x-1"></span>
                </button>
            </div>

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
                            Language
                        </h4>
                        <p class="text-sm text-gray-500">
                            Select your preferred language
                        </p>
                    </div>
                </div>

                <div class="relative">
                    <select id="locale-select"
                            class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer">
                        <option value="en">🇺🇸 English</option>
                        <option value="es">🇪🇸 Español</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6,9 12,15 18,9"></polyline>
                        </svg>
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
            Save Changes
        </button>
    </div>
</div>
