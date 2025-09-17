// --- Data for the tools ---
const toolData = [
    {
        category: "🖼 Image Tools",
        description: "Edit, convert, and optimize your images effortlessly.",
        tools: [
            { name: "Image Converter", desc: "Change image formats like PNG, JPG, WEBP." },
            { name: "Image Compressor", desc: "Reduce image file size without losing quality." },
            { name: "Image Resizer", desc: "Adjust the dimensions of your images." },
            { name: "Image Cropper", desc: "Crop images to a specific area." },
            { name: "Image to Text (OCR)", desc: "Extract text from your images." },
            { name: "Image Rotator/Flipper", desc: "Rotate and flip your images easily." },
        ]
    },
    {
        category: "📄 Document Tools",
        description: "Manage your PDFs and other documents with ease.",
        tools: [
            { name: "PDF to Word / Word to PDF", desc: "Convert documents between PDF and Word." },
            { name: "PDF Compressor", desc: "Reduce the file size of your PDF documents." },
            { name: "PDF Merger & Splitter", desc: "Combine multiple PDFs or split one." },
            { name: "Document Converter", desc: "Convert various document formats." },
            { name: "PDF Lock/Unlock", desc: "Add or remove password protection from PDFs." },
            { name: "eSign PDF", desc: "Sign your PDF documents electronically." },
        ]
    },
    {
        category: "🧮 Calculator Tools",
        description: "Perform various calculations for finance, health, and more.",
        tools: [
            { name: "Scientific Calculator", desc: "Perform complex mathematical calculations." },
            { name: "Age Calculator", desc: "Find out your exact age in years, months, days." },
            { name: "BMI Calculator", desc: "Check your Body Mass Index for health insights." },
            { name: "Loan EMI Calculator", desc: "Calculate your equated monthly loan installments." },
            { name: "GST Calculator", desc: "Calculate Goods and Services Tax." },
            { name: "Currency Converter", desc: "Convert between different currencies." },
        ]
    },
    {
        category: "🔤 Text Tools",
        description: "Manipulate and analyze your text with these handy tools.",
        tools: [
            { name: "Text Case Converter", desc: "Switch text between uppercase, lowercase, etc." },
            { name: "Word & Character Counter", desc: "Count words and characters in your text." },
            { name: "Remove Duplicate Lines", desc: "Eliminate duplicate lines from text." },
            { name: "Text Sorter", desc: "Sort lines of text alphabetically or numerically." },
            { name: "Text Reverser", desc: "Reverse characters, words, or lines." },
            { name: "Text Encryptor/Decryptor", desc: "Securely encrypt or decrypt text." },
        ]
    },
    {
        category: "🌐 Web/Developer Tools",
        description: "Essential tools for web developers and programmers.",
        tools: [
            { name: "HTML/CSS/JS Minifier", desc: "Minify code to reduce file size and load times." },
            { name: "JSON Formatter & Validator", desc: "Format and validate your JSON data." },
            { name: "Base64 Encoder/Decoder", desc: "Encode or decode data in Base64." },
            { name: "URL Encoder/Decoder", desc: "Encode or decode special characters in URLs." },
            { name: "Color Picker & Converter", desc: "Pick colors and convert between formats." },
            { name: "Regex Tester", desc: "Test and debug your regular expressions." },
        ]
    },
    {
        category: "🎨 Color Tools",
        description: "A suite of tools for all your color-related tasks.",
        tools: [
            { name: "Color Picker from Image", desc: "Extract dominant colors from an image." },
            { name: "HEX to RGB Converter", desc: "Convert HEX color codes to RGB values." },
            { name: "Gradient Generator", desc: "Create beautiful CSS color gradients." },
            { name: "Contrast Checker", desc: "Check color contrast for accessibility." },
            { name: "Palette Generator", desc: "Generate harmonious color palettes." },
            { name: "Color Blindness Simulator", desc: "Simulate color vision deficiencies." },
        ]
    },
    {
        category: "🌍 SEO & Marketing Tools",
        description: "Tools to help with your SEO and marketing efforts.",
        tools: [
            { name: "Keyword Density Checker", desc: "Analyze the keyword density of your text." },
            { name: "Meta Tag Analyzer", desc: "Inspect the meta tags of a webpage." },
            { name: "Word Counter", desc: "Quickly count the words in any text." },
        ]
    },
    {
        category: "🛠️ Utility Tools",
        description: "A collection of miscellaneous utility tools for daily tasks.",
        tools: [
            { name: "QR Code Generator & Scanner", desc: "Generate and scan QR codes easily." },
            { name: "Barcode Generator", desc: "Create various types of barcodes." },
            { name: "UUID Generator", desc: "Generate universally unique identifiers." },
            { name: "Unit Converter", desc: "Convert between various units of measurement." },
            { name: "Time Zone Converter", desc: "Convert times between different time zones." },
            { name: "Random Number/Password Generator", desc: "Create random numbers or secure passwords." },
        ]
    }
];

/**
 * Generates the tool cards and sections and injects them into the DOM.
 */
function generateTools() {
    const toolsContainer = document.getElementById('tools');
    if (!toolsContainer) return;

    const allSectionsHtml = toolData.map(section => {
        const toolsHtml = section.tools.map(tool => `
            <div class="tool-card card-hidden glass-effect bg-white/50 dark:bg-gray-800/50 p-6 rounded-lg shadow-md border border-white/60 dark:border-gray-700/60">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white tool-name">${tool.name}</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1 tool-desc">${tool.desc}</p>
                <a href="#" class="inline-block mt-4 bg-blue-50 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 font-semibold py-2 px-4 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors">Use Tool</a>
            </div>
        `).join('');

        return `
            <section class="tool-section my-16" data-category="${section.category}">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white">${section.category}</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2">${section.description}</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                    ${toolsHtml}
                </div>
            </section>
        `;
    }).join('');

    toolsContainer.innerHTML = allSectionsHtml;
}

/**
 * Sets up the interactive category filters.
 */
function setupCategoryFilters() {
    const filterButtonsContainer = document.getElementById('filter-buttons');
    if (!filterButtonsContainer) return;

    const categories = ['All', ...new Set(toolData.map(item => item.category))];

    const buttonsHtml = categories.map(category => {
        const isActive = category === 'All';
        const baseClasses = 'filter-btn px-4 py-2 font-semibold rounded-lg transition-colors duration-200';
        const activeClasses = 'bg-blue-600 text-white';
        const inactiveClasses = 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600';
        return `<button class="${baseClasses} ${isActive ? activeClasses : inactiveClasses}" data-category="${category}">${category.split(' ')[1] || category}</button>`;
    }).join('');

    filterButtonsContainer.innerHTML = buttonsHtml;

    filterButtonsContainer.addEventListener('click', (event) => {
        const target = event.target;
        if (!target.matches('.filter-btn')) return;

        // Update active button style
        filterButtonsContainer.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-200', 'hover:bg-gray-300', 'dark:hover:bg-gray-600');
        });
        target.classList.add('bg-blue-600', 'text-white');
        target.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-200', 'hover:bg-gray-300', 'dark:hover:bg-gray-600');

        // Filter sections
        const selectedCategory = target.dataset.category;
        document.querySelectorAll('.tool-section').forEach(section => {
            if (selectedCategory === 'All' || section.dataset.category === selectedCategory) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });
    });
}


/**
 * Sets up the mobile menu toggle functionality with focus trapping.
 */
function setupMobileMenu() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (!mobileMenuButton || !mobileMenu) return;

    const focusableElements = mobileMenu.querySelectorAll('a[href], button');
    const firstFocusableElement = focusableElements[0];
    const lastFocusableElement = focusableElements[focusableElements.length - 1];
    let lastFocusedElement;

    function openMenu() {
        lastFocusedElement = document.activeElement;
        mobileMenu.classList.remove('hidden');
        mobileMenuButton.setAttribute('aria-expanded', 'true');
        firstFocusableElement.focus();
        document.addEventListener('keydown', trapFocus);
    }

    function closeMenu() {
        mobileMenu.classList.add('hidden');
        mobileMenuButton.setAttribute('aria-expanded', 'false');
        if (lastFocusedElement) {
            lastFocusedElement.focus();
        }
        document.removeEventListener('keydown', trapFocus);
    }

    function trapFocus(event) {
        if (event.key !== 'Tab') return;

        if (event.shiftKey) {
            if (document.activeElement === firstFocusableElement) {
                event.preventDefault();
                lastFocusableElement.focus();
            }
        } else {
            if (document.activeElement === lastFocusableElement) {
                event.preventDefault();
                firstFocusableElement.focus();
            }
        }
    }

    mobileMenuButton.addEventListener('click', () => {
        const isHidden = mobileMenu.classList.contains('hidden');
        if (isHidden) {
            openMenu();
        } else {
            closeMenu();
        }
    });
}

/**
 * Sets up the live search functionality for tools.
 */
function setupLiveSearch() {
    const searchInput = document.getElementById('tool-search');
    if (!searchInput) return;

    searchInput.addEventListener('keyup', (event) => {
        const query = event.target.value.toLowerCase().trim();

        // When searching, reset category filter to "All" to avoid conflicts
        const allButton = document.querySelector('.filter-btn[data-category="All"]');
        if (allButton) allButton.click();

        const toolSections = document.querySelectorAll('.tool-section');

        toolSections.forEach(section => {
            const toolCards = section.querySelectorAll('.tool-card');
            let sectionHasVisibleCards = false;

            toolCards.forEach(card => {
                const title = card.querySelector('.tool-name').textContent.toLowerCase();
                const description = card.querySelector('.tool-desc').textContent.toLowerCase();

                if (title.includes(query) || description.includes(query)) {
                    card.style.display = 'block';
                    sectionHasVisibleCards = true;
                } else {
                    card.style.display = 'none';
                }
            });

            section.style.display = sectionHasVisibleCards ? 'block' : 'none';
        });
    });
}

/**
 * Sets up the theme switcher functionality.
 */
function setupThemeSwitcher() {
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleButton = document.getElementById('theme-toggle');

    if (!themeToggleButton) return;

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    themeToggleButton.addEventListener('click', function() {
        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // if set via local storage previously
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
    });
}

/**
 * Sets up on-scroll animations for elements like tool cards.
 */
function setupScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('card-visible');
                entry.target.classList.remove('card-hidden');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    const cards = document.querySelectorAll('.tool-card');
    cards.forEach(card => {
        // A more robust check to see if any part of the card is in the viewport.
        // This is more reliable in different browser environments and timings.
        const rect = card.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom >= 0) {
            card.classList.add('card-visible');
            card.classList.remove('card-hidden');
        } else {
            // Otherwise, observe it for scrolling.
            observer.observe(card);
        }
    });
}


// --- App Initialization ---
generateTools();
setupCategoryFilters();
setupMobileMenu();
setupLiveSearch();
setupThemeSwitcher();
setupScrollAnimations();
