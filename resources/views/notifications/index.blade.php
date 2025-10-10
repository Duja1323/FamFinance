<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Barre de recherche et filtres -->
                    <div class="mb-6">
                        <form action="{{ route('notifications.index') }}" method="GET" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="md:col-span-2">
                                    <div class="relative">
                                        <input type="text" 
                                               name="search" 
                                               value="{{ request('search') }}"
                                               placeholder="{{ __('Rechercher dans les notifications...') }}"
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i class="fas fa-search text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <select name="type" 
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="all">{{ __('Tous les types') }}</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex space-x-2">
                                    <input type="date" 
                                           name="date_from" 
                                           value="{{ request('date_from') }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <input type="date" 
                                           name="date_to" 
                                           value="{{ request('date_to') }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('notifications.index') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-gray-600 uppercase tracking-widest hover:bg-gray-200 focus:bg-gray-200 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <i class="fas fa-redo-alt mr-2"></i>
                                    {{ __('Réinitialiser') }}
                                </a>
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <i class="fas fa-filter mr-2"></i>
                                    {{ __('Filtrer') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <div x-data='{ 
                        notifications: @json($notifications),
                        activeTab: "all",
                        filterNotifications() {
                            if (this.activeTab === "all") return this.notifications.data;
                            if (this.activeTab === "unread") return this.notifications.data.filter(n => !n.read_at);
                            return this.notifications.data.filter(n => n.read_at);
                        },
                        async markAllAsRead() {
                            try {
                                const response = await fetch("{{ route('notifications.markAllAsRead') }}", {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Accept": "application/json"
                                    }
                                });
                                if (response.ok) {
                                    this.notifications.data.forEach(n => n.read_at = new Date().toISOString());
                                }
                            } catch (error) {
                                console.error("Erreur lors du marquage des notifications:", error);
                            }
                        },
                        async markAsRead(id) {
                            try {
                                const response = await fetch(`/notifications/${id}/mark-read`, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Accept": "application/json"
                                    }
                                });
                                if (response.ok) {
                                    const notification = this.notifications.data.find(n => n.id === id);
                                    if (notification) {
                                        notification.read_at = new Date().toISOString();
                                    }
                                }
                            } catch (error) {
                                console.error("Erreur lors du marquage de la notification:", error);
                            }
                        }
                    }'>
                        <div class="mb-6 flex justify-between items-center">
                            <div class="flex space-x-1">
                                <button 
                                    @click="activeTab = 'all'" 
                                    :class="{'bg-indigo-600 text-white': activeTab === 'all', 'bg-gray-200 text-gray-700 hover:bg-gray-300': activeTab !== 'all'}"
                                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    Toutes <span class="ml-1 text-xs" x-text="notifications.data.length"></span>
                                </button>
                                <button 
                                    @click="activeTab = 'unread'" 
                                    :class="{'bg-indigo-600 text-white': activeTab === 'unread', 'bg-gray-200 text-gray-700 hover:bg-gray-300': activeTab !== 'unread'}"
                                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    Non lues <span class="ml-1 text-xs" x-text="notifications.data.filter(n => !n.read_at).length"></span>
                                </button>
                                <button 
                                    @click="activeTab = 'read'" 
                                    :class="{'bg-indigo-600 text-white': activeTab === 'read', 'bg-gray-200 text-gray-700 hover:bg-gray-300': activeTab !== 'read'}"
                                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    Lues <span class="ml-1 text-xs" x-text="notifications.data.filter(n => n.read_at).length"></span>
                                </button>
                            </div>
                            <button 
                                @click.prevent="markAllAsRead()" 
                                class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center"
                                x-show="notifications.data.some(n => !n.read_at)">
                                <i class="fas fa-check-double mr-1"></i> Tout marquer comme lu
                            </button>
                        </div>

                        <div class="bg-white shadow overflow-hidden rounded-md">
                            <ul class="divide-y divide-gray-200">
                                <template x-for="notification in filterNotifications()" :key="notification.id">
                                    <li :class="{'bg-indigo-50': !notification.read_at}" class="transition-colors duration-150">
                                        <a :href="notification.link" @click="markAsRead(notification.id)" class="block hover:bg-gray-50">
                                            <div class="px-4 py-4 flex items-start sm:px-6">
                                                <div class="flex-shrink-0 mt-1">
                                                    <div class="h-10 w-10 rounded-full flex items-center justify-center text-white" :class="notification.color">
                                                        <i class="fas" :class="notification.icon"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-4 flex-1">
                                                    <div class="flex justify-between">
                                                        <div>
                                                            <p class="text-sm font-medium text-gray-900 flex items-center">
                                                                <span x-text="notification.title"></span>
                                                                <span x-show="!notification.read_at" class="ml-2 h-2 w-2 rounded-full bg-indigo-600"></span>
                                                            </p>
                                                            <p class="mt-1 text-sm text-gray-600" x-text="notification.message"></p>
                                                        </div>
                                                        <p class="text-xs text-gray-500" x-text="new Date(notification.created_at).toLocaleDateString()"></p>
                                                    </div>
                                                    <div class="mt-2 flex items-center text-xs text-gray-500">
                                                        <span class="mr-2" x-text="new Date(notification.created_at).toLocaleTimeString()"></span>
                                                        <button 
                                                            @click.stop.prevent="markAsRead(notification.id)" 
                                                            x-show="!notification.read_at"
                                                            class="ml-auto text-indigo-600 hover:text-indigo-800">
                                                            Marquer comme lu
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </template>
                                <template x-if="filterNotifications().length === 0">
                                    <li class="px-4 py-8 text-center">
                                        <div class="text-gray-500">
                                            <i class="fas fa-bell-slash text-3xl mb-3"></i>
                                            <p class="text-lg font-medium">Aucune notification</p>
                                            <p class="mt-1" x-show="activeTab === 'unread'">Vous avez lu toutes vos notifications.</p>
                                            <p class="mt-1" x-show="activeTab === 'all'">Vous n'avez pas encore reçu de notifications.</p>
                                        </div>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $notifications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>