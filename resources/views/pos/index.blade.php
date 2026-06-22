@extends($layout)

@section('title', 'POS Kasir | Hi Venus')

@section('content')
    <div class="flex flex-col h-auto md:h-[calc(100vh-140px)] -m-4 md:-m-margin-desktop overflow-visible md:p-5">
        <div class="flex-1 grid grid-cols-1 md:grid-cols-12 overflow-visible md:overflow-hidden max-w-none w-full bg-surface-bright border-4 border-on-background rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] min-h-screen md:min-h-0">

            {{-- Left: Product Search & Grid --}}
            <section class="md:col-span-7 flex flex-col bg-surface-bright border-b-4 md:border-b-0 md:border-r-4 border-on-background p-6 overflow-visible md:overflow-hidden relative animate-fade-in-left">
                {{-- Search & Filters --}}
                <div class="flex flex-col gap-6 mb-6">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-6 top-1/2 -translate-y-1/2 text-primary text-3xl">search</span>
                        <input type="text" id="searchInput" placeholder="Cari nama produk..."
                            class="w-full bg-surface-container-lowest border-4 border-on-background rounded-full pl-16 pr-4 py-3 font-body-md text-body-md shadow-[inset_0px_4px_0px_0px_rgba(0,0,0,0.05)] focus:border-tertiary-container focus:ring-0 outline-none transition-all">
                    </div>
                    <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide stagger-container" id="categoryFilters">
                        <button data-cat="all" class="cat-btn bg-primary text-on-primary border-4 border-on-background rounded-full px-8 py-2 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all whitespace-nowrap">
                            Semua Produk
                        </button>
                        @foreach($categories as $cat)
                            <button data-cat="{{ $cat->id }}" class="cat-btn bg-surface-bright text-on-background border-4 border-on-background rounded-full px-8 py-2 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all whitespace-nowrap">
                                {{ $cat->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Product Grid --}}
                <div class="flex-1 overflow-y-visible md:overflow-y-auto pr-2 grid grid-cols-2 lg:grid-cols-4 gap-6 pb-6 stagger-container" id="productGrid">
                    <!-- Products rendered via JS -->
                </div>
            </section>

            {{-- Right: Cart & Checkout (Live Bag) --}}
            <section class="md:col-span-5 flex flex-col bg-surface-container-low p-8 overflow-visible md:overflow-hidden animate-fade-in-right">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="font-headline-lg text-headline-lg font-black italic">Live Bag <span id="cartCount" class="text-sm bg-primary text-on-primary px-2 rounded-full ml-2">0</span></h2>
                    <button onclick="clearCart()"
                        class="bg-surface-bright text-error border-4 border-error rounded-lg px-4 py-2 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_#ba1a1a] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_#ba1a1a] transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined">delete_sweep</span>
                        Clear
                    </button>
                </div>

                {{-- Cart Items --}}
                <div class="flex-1 overflow-y-visible md:overflow-y-auto space-y-4 mb-8 pr-2 stagger-container" id="cartContainer">
                    <!-- Cart items rendered via JS -->
                    <div id="emptyCart" class="text-center text-on-surface-variant italic mt-10">Keranjang kosong. Tambahkan produk.</div>
                </div>

                {{-- Summary & Checkout --}}
                <div class="mt-auto flex flex-col gap-6">
                    <div class="bg-surface-bright border-4 border-on-background rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] p-6">
                        <div class="flex flex-col gap-3 mb-4">
                            <div class="flex justify-between font-bold text-on-surface-variant italic">
                                <span>Subtotal</span><span id="txtSubtotal">Rp 0</span></div>
                            <div class="flex justify-between font-bold text-on-surface-variant italic">
                                <span>Pajak (11%)</span><span id="txtTax">Rp 0</span></div>
                        </div>
                        <div class="pt-4 border-t-4 border-dashed border-on-background flex justify-between items-end">
                            <span class="font-headline-lg text-headline-lg font-black italic">Total</span>
                            <span id="txtTotal" class="font-price-display text-price-display text-primary text-4xl leading-none">Rp 0</span>
                        </div>
                    </div>

                    <button id="btnOpenCheckout" onclick="openCheckoutModal()" disabled
                        class="w-full bg-primary text-on-primary border-4 border-on-background rounded-lg py-4 font-headline-lg-mobile text-headline-lg-mobile shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex items-center justify-center gap-2 disabled:opacity-50 disabled:pointer-events-none">
                        <span class="material-symbols-outlined text-4xl">payments</span> Bayar Sekarang
                    </button>
                </div>
            </section>
        </div>
    </div>

    <!-- Variant Selector Modal -->
    <div id="variantModal" class="fixed inset-0 z-[100] bg-black/60 hidden items-center justify-center p-4">
        <div class="bg-surface-bright border-4 border-on-background rounded-2xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] p-8 max-w-lg w-full animate-scale-in relative">
            <button onclick="closeVariantModal()" class="absolute top-4 right-4 bg-error text-on-error w-8 h-8 rounded-full border-2 border-on-background flex items-center justify-center font-bold">X</button>
            <h3 class="font-headline-md text-primary mb-2" id="vModalTitle">Pilih Variasi</h3>
            <div id="vModalOptions" class="grid grid-cols-2 gap-4 mt-6 max-h-[300px] overflow-y-auto">
                <!-- Variants rendered here -->
            </div>
        </div>
    </div>

    <!-- Checkout Calculator Modal -->
    <div id="checkoutModal" class="fixed inset-0 z-[100] bg-black/60 hidden items-center justify-center p-4">
        <div class="bg-surface-bright border-4 border-on-background rounded-2xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] p-8 max-w-md w-full animate-scale-in relative">
            <button onclick="closeCheckoutModal()" class="absolute top-4 right-4 bg-error text-on-error w-8 h-8 rounded-full border-2 border-on-background flex items-center justify-center font-bold">X</button>
            <h3 class="font-headline-lg text-primary mb-6 text-center italic">Kalkulator Pembayaran</h3>
            
            <div class="bg-surface-container-low border-2 border-on-background rounded-xl p-4 mb-6 text-center">
                <p class="text-on-surface-variant font-bold mb-1">Total Tagihan</p>
                <p class="font-price-display text-4xl text-primary" id="calcTotal">Rp 0</p>
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-2">Nominal Uang Diterima (Rp)</label>
                <input type="number" id="cashInput" placeholder="Contoh: 100000" oninput="calculateChange()"
                    class="w-full bg-white border-4 border-on-background rounded-xl px-4 py-3 font-body-lg text-body-lg shadow-[inset_0px_4px_0px_0px_rgba(0,0,0,0.05)] focus:border-primary focus:ring-0 outline-none text-right font-bold text-2xl">
            </div>
            
            {{-- Quick Cash Buttons --}}
            <div class="grid grid-cols-3 gap-3 mb-6" id="quickCashButtons">
                <!-- Dinamis di-generate JS berdasarkan total -->
            </div>

            <div class="bg-tertiary-container border-2 border-on-background rounded-xl p-4 mb-8 text-center transition-all" id="changeBox">
                <p class="text-on-tertiary-container font-bold mb-1">Kembalian</p>
                <p class="font-price-display text-3xl text-on-tertiary-container" id="calcChange">Rp 0</p>
            </div>

            <button id="btnConfirmPayment" onclick="processPayment()" disabled
                class="w-full bg-primary text-on-primary border-4 border-on-background rounded-lg py-4 font-headline-lg-mobile text-headline-lg-mobile shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex items-center justify-center gap-2 disabled:opacity-50 disabled:pointer-events-none">
                <span class="material-symbols-outlined">check_circle</span> Proses Transaksi & Cetak
            </button>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const products = @json($products);
    let cart = [];
    let currentCategory = 'all';
    let searchQuery = '';
    
    let totalCartAmount = 0;
    
    const productGrid = document.getElementById('productGrid');
    const cartContainer = document.getElementById('cartContainer');
    const searchInput = document.getElementById('searchInput');
    const catBtns = document.querySelectorAll('.cat-btn');

    // Utility: Format Rupiah
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }

    // Render Products
    function renderProducts() {
        productGrid.innerHTML = '';
        let filtered = products.filter(p => {
            let matchSearch = p.name.toLowerCase().includes(searchQuery.toLowerCase());
            let matchCat = currentCategory === 'all' || p.category_id == currentCategory;
            return matchSearch && matchCat;
        });

        if (filtered.length === 0) {
            productGrid.innerHTML = '<div class="col-span-2 lg:col-span-4 text-center py-10 text-on-surface-variant font-bold">Produk tidak ditemukan.</div>';
            return;
        }

        filtered.forEach(p => {
            const hasVariants = p.variants && p.variants.length > 0;
            const bgColors = ['bg-primary-container', 'bg-secondary-container', 'bg-tertiary-container', 'bg-surface-variant'];
            const randomBg = bgColors[p.id % bgColors.length];
            const imgSrc = p.image ? `/storage/${p.image}` : null;
            
            const card = document.createElement('div');
            card.className = "bg-surface-bright border-4 border-on-background rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all p-3 flex flex-col items-center text-center cursor-pointer active:scale-95";
            card.onclick = () => handleProductClick(p);
            
            let imgHtml = '';
            if (imgSrc) {
                imgHtml = `<img src="${imgSrc}" class="w-full h-full object-cover group-hover:scale-110 transition-transform" />`;
            } else {
                imgHtml = `<span class="material-symbols-outlined text-4xl text-on-background" style="font-variation-settings: 'FILL' 1;">shopping_bag</span>`;
            }

            card.innerHTML = `
                <div class="aspect-square w-full rounded-lg overflow-hidden mb-2 ${randomBg} border-2 border-on-background flex items-center justify-center bg-[radial-gradient(#ffffff_2px,transparent_2px)] [background-size:12px_12px] group">
                    ${imgHtml}
                </div>
                <p class="font-bold text-sm text-on-background line-clamp-2 leading-tight h-8 mb-1">${p.name}</p>
                <p class="font-price-display text-primary text-sm">${formatRupiah(p.price)}</p>
            `;
            productGrid.appendChild(card);
        });
    }

    // Handle Product Click
    function handleProductClick(product) {
        if (product.variants && product.variants.length > 0) {
            openVariantModal(product);
        } else {
            addToCart(product, null);
        }
    }

    // Variant Modal
    const variantModal = document.getElementById('variantModal');
    const vModalTitle = document.getElementById('vModalTitle');
    const vModalOptions = document.getElementById('vModalOptions');

    function openVariantModal(product) {
        vModalTitle.innerText = `Pilih Variasi: ${product.name}`;
        vModalOptions.innerHTML = '';
        
        product.variants.forEach(v => {
            const btn = document.createElement('button');
            btn.type = 'button';
            const isOutOfStock = v.stock <= 0;
            btn.className = `p-3 border-4 border-on-background rounded-xl font-bold text-sm text-left transition-all ${isOutOfStock ? 'bg-surface-container opacity-50' : 'bg-white hover:-translate-y-1 hover:shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]'}`;
            btn.innerHTML = `
                <div class="flex justify-between items-center mb-1">
                    <span class="pointer-events-none">${v.color} - ${v.size}</span>
                    <div class="w-4 h-4 rounded-full border border-on-background pointer-events-none" style="background-color: ${v.color_hex || '#ccc'}"></div>
                </div>
                <div class="text-xs ${isOutOfStock ? 'text-error' : 'text-primary'} pointer-events-none">Stok: ${v.stock}</div>
            `;
            
            // Menggunakan attribute onclick secara eksplisit
            btn.setAttribute('onclick', `selectVariant(${product.id}, ${v.id})`);
            
            vModalOptions.appendChild(btn);
        });

        variantModal.classList.remove('hidden');
        variantModal.classList.add('flex');
    }

    // Global handler untuk memilih variant
    window.selectVariant = function(productId, variantId) {
        const product = products.find(p => p.id == productId);
        if (!product) return;
        
        const variant = product.variants.find(v => v.id == variantId);
        if (!variant) return;

        if (variant.stock <= 0) {
            alert('Maaf, stok untuk variasi ini sedang kosong!');
            return;
        }

        addToCart(product, variant);
        closeVariantModal();
    };

    function closeVariantModal() {
        variantModal.classList.add('hidden');
        variantModal.classList.remove('flex');
    }

    // Add to Cart
    function addToCart(product, variant = null) {
        const itemKey = variant ? `${product.id}-${variant.id}` : `${product.id}-null`;
        const existing = cart.find(i => i.key === itemKey);

        if (existing) {
            // Check stock if variant exists
            if (variant && existing.qty >= variant.stock) {
                alert('Stok varian tidak mencukupi!');
                return;
            }
            existing.qty++;
        } else {
            cart.push({
                key: itemKey,
                product_id: product.id,
                variant_id: variant ? variant.id : null,
                name: product.name,
                variant_name: variant ? `${variant.color} - ${variant.size}` : null,
                price: parseFloat(product.price),
                qty: 1
            });
        }
        updateCartUI();
    }

    function updateCartQty(key, delta) {
        const itemIndex = cart.findIndex(i => i.key === key);
        if (itemIndex > -1) {
            cart[itemIndex].qty += delta;
            if (cart[itemIndex].qty <= 0) {
                cart.splice(itemIndex, 1);
            }
            updateCartUI();
        }
    }

    function clearCart() {
        if(confirm('Kosongkan Live Bag?')) {
            cart = [];
            updateCartUI();
        }
    }

    // Render Cart
    function updateCartUI() {
        cartContainer.innerHTML = '';
        
        if (cart.length === 0) {
            cartContainer.innerHTML = '<div id="emptyCart" class="text-center text-on-surface-variant italic mt-10">Keranjang kosong. Tambahkan produk.</div>';
        }
        
        let subtotal = 0;
        let totalItems = 0;

        cart.forEach(item => {
            subtotal += item.price * item.qty;
            totalItems += item.qty;

            const div = document.createElement('div');
            div.className = "bg-white border-2 border-on-background rounded-xl p-3 flex flex-col gap-2";
            div.innerHTML = `
                <div class="flex justify-between items-start">
                    <div class="flex-1 pr-2">
                        <p class="font-bold text-sm leading-tight text-on-background">${item.name}</p>
                        ${item.variant_name ? `<p class="text-xs text-on-surface-variant font-medium mt-0.5">Var: ${item.variant_name}</p>` : ''}
                    </div>
                    <button onclick="updateCartQty('${item.key}', -${item.qty})" class="text-error font-bold text-xl leading-none">&times;</button>
                </div>
                <div class="flex justify-between items-center mt-1">
                    <p class="font-price-display text-primary">${formatRupiah(item.price * item.qty)}</p>
                    <div class="flex items-center gap-2 bg-surface-container-lowest rounded-lg border border-outline px-1 py-1">
                        <button onclick="updateCartQty('${item.key}', -1)" class="w-6 h-6 flex items-center justify-center font-bold bg-surface-variant rounded">-</button>
                        <span class="font-bold w-4 text-center text-sm">${item.qty}</span>
                        <button onclick="updateCartQty('${item.key}', 1)" class="w-6 h-6 flex items-center justify-center font-bold bg-primary text-white rounded">+</button>
                    </div>
                </div>
            `;
            cartContainer.appendChild(div);
        });

        document.getElementById('cartCount').innerText = totalItems;
        
        const tax = subtotal * 0.11;
        totalCartAmount = subtotal + tax;

        document.getElementById('txtSubtotal').innerText = formatRupiah(subtotal);
        document.getElementById('txtTax').innerText = formatRupiah(tax);
        document.getElementById('txtTotal').innerText = formatRupiah(totalCartAmount);

        document.getElementById('btnOpenCheckout').disabled = cart.length === 0;
    }

    // Checkout Modal Logic
    const checkoutModal = document.getElementById('checkoutModal');
    const cashInput = document.getElementById('cashInput');
    const btnConfirmPayment = document.getElementById('btnConfirmPayment');
    const calcChange = document.getElementById('calcChange');

    function openCheckoutModal() {
        document.getElementById('calcTotal').innerText = formatRupiah(totalCartAmount);
        cashInput.value = '';
        calcChange.innerText = 'Rp 0';
        btnConfirmPayment.disabled = true;
        
        // Generate quick cash buttons
        generateQuickCash();

        checkoutModal.classList.remove('hidden');
        checkoutModal.classList.add('flex');
        setTimeout(() => cashInput.focus(), 100);
    }

    function closeCheckoutModal() {
        checkoutModal.classList.add('hidden');
        checkoutModal.classList.remove('flex');
    }

    function setCash(amount) {
        cashInput.value = amount;
        calculateChange();
    }

    function generateQuickCash() {
        const btnContainer = document.getElementById('quickCashButtons');
        btnContainer.innerHTML = '';
        
        // Buat pecahan uang yang relevan
        let amount = Math.ceil(totalCartAmount);
        const thresholds = [50000, 100000, 150000, 200000, 300000, 500000, 1000000];
        
        // Pas uang total
        btnContainer.innerHTML += `<button onclick="setCash(${amount})" class="bg-white border-2 border-primary text-primary rounded-lg py-2 font-bold text-sm hover:bg-primary-container">Uang Pas</button>`;
        
        // Cari 2 pecahan di atas total
        let count = 0;
        for(let i=0; i<thresholds.length; i++){
            if(thresholds[i] > amount && count < 2) {
                btnContainer.innerHTML += `<button onclick="setCash(${thresholds[i]})" class="bg-white border-2 border-on-background rounded-lg py-2 font-bold text-sm hover:bg-surface-variant">${formatRupiah(thresholds[i]).replace(',00', '')}</button>`;
                count++;
            }
        }
    }

    function calculateChange() {
        const cash = parseFloat(cashInput.value) || 0;
        const change = cash - totalCartAmount;
        
        if (cash >= totalCartAmount) {
            calcChange.innerText = formatRupiah(change);
            calcChange.classList.remove('text-error');
            calcChange.classList.add('text-on-tertiary-container');
            btnConfirmPayment.disabled = false;
        } else {
            calcChange.innerText = 'Uang Kurang!';
            calcChange.classList.add('text-error');
            calcChange.classList.remove('text-on-tertiary-container');
            btnConfirmPayment.disabled = true;
        }
    }

    // Process Payment via Fetch API
    function processPayment() {
        btnConfirmPayment.disabled = true;
        btnConfirmPayment.innerHTML = '<span class="material-symbols-outlined animate-spin">refresh</span> Memproses...';

        const cash = parseFloat(cashInput.value);

        const payload = {
            _token: '{{ csrf_token() }}',
            items: cart.map(i => ({
                product_id: i.product_id,
                variant_id: i.variant_id,
                qty: i.qty,
                price: i.price
            })),
            total_amount: totalCartAmount,
            cash_received: cash
        };

        fetch('{{ route('pos.checkout') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                // Redirect ke struk
                window.location.href = `{{ route('cashier.receipt') }}?order_id=${data.order_id}`;
            } else {
                alert('Gagal: ' + data.message);
                btnConfirmPayment.disabled = false;
                btnConfirmPayment.innerHTML = '<span class="material-symbols-outlined">check_circle</span> Proses Transaksi & Cetak';
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan jaringan.');
            console.error(err);
            btnConfirmPayment.disabled = false;
            btnConfirmPayment.innerHTML = '<span class="material-symbols-outlined">check_circle</span> Proses Transaksi & Cetak';
        });
    }

    // Event Listeners
    searchInput.addEventListener('input', (e) => {
        searchQuery = e.target.value;
        renderProducts();
    });

    catBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            catBtns.forEach(b => {
                b.classList.remove('bg-primary', 'text-on-primary');
                b.classList.add('bg-surface-bright', 'text-on-background');
            });
            const t = e.currentTarget;
            t.classList.remove('bg-surface-bright', 'text-on-background');
            t.classList.add('bg-primary', 'text-on-primary');
            currentCategory = t.getAttribute('data-cat');
            renderProducts();
        });
    });

    // Initial render
    renderProducts();
    updateCartUI();
</script>
@endpush