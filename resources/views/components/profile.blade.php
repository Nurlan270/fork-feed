<main class="min-h-screen flex items-start justify-center">
    <div class="max-w-7xl w-full min-h-screen bg-white/90 shadow-md p-4 backdrop-blur-sm">
        <div class="relative w-full mb-6 md:mb-10">
            <div class="relative w-full mb-6 md:mb-10">
                <!-- Banner -->
                <div class="group relative">
                    <img src="{{ asset('media/recipe-create.jpg') }}" alt="Profile Banner"
                         class="w-full h-40 md:h-48 rounded-lg object-cover">
                </div>

                <!-- Avatar -->
                <div class="absolute -bottom-6 left-4">
                    <img src="{{ $user->avatar }}" alt="Profile Avatar"
                         class="w-16 h-16 md:w-20 md:h-20 rounded-full border-4 border-white object-cover">
                </div>
            </div>
        </div>

        <!-- Name and username -->
        <div class="flex justify-between items-center mb-6 text-left px-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-primary-800">{{ $user->name }}</h2>
                <p class="text-sm md:text-base text-primary-900">{{ '@' . $user->username }}</p>
            </div>

            <livewire:buttons.subscription-button :$user/>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 mb-4 md:mb-6">
            <!-- Left Column: Profile, Bookmarks, Ingredients -->
            <div class="md:col-span-3 space-y-4 md:sticky top-5 self-start">
                <!-- Profile Information -->
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <h3 class="text-base md:text-lg font-semibold text-primary-800">
                        Profile Information
                    </h3>
                    <div class="grid grid-cols-3 gap-x-2 md:gap-x-4 text-center py-3 border-b-2 border-b-gray-200">
                        <a href="{{ route('user.tag-profile', compact('user')) }}"
                           class="rounded py-3 hover:bg-gray-100 transition-colors ">
                                <span class="block text-xl md:text-2xl font-bold text-[#408D45]">
                                    {{ $user->recipes->count() }}
                                </span>
                            <span class="block text-xs md:text-sm text-primary-900">Recipes</span>
                        </a>
                        <a href="{{ route('user.followers', compact('user')) }}"
                           class="rounded py-3 hover:bg-gray-100 transition-colors">
                                <span class="block text-xl md:text-2xl font-bold text-[#408D45]">
                                    {{ $user->followers->count() }}
                                </span>
                            <span class="block text-xs md:text-sm text-primary-900">Followers</span>
                        </a>
                        <a href="{{ route('user.following', compact('user')) }}"
                           class="rounded py-3 hover:bg-gray-100 transition-colors">
                                <span class="block text-xl md:text-2xl font-bold text-[#408D45]">
                                    {{ $user->following->count() }}
                                </span>
                            <span class="block text-xs md:text-sm text-primary-900">Following</span>
                        </a>
                    </div>
                    <div class="flex justify-between mt-5">
                        <span class="text-primary-900">Joined</span>
                        <span class="font-medium text-[#3A883E]">{{ $user->created_at->format('M, Y') }}</span>
                    </div>
                </div>

                {{ $sidebar ?? '' }}
            </div>

            {{ $slot }}
        </div>
    </div>
</main>
