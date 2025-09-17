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
            <div class="tool-card bg-white p-6 rounded-lg shadow-md border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 tool-name">${tool.name}</h3>
                <p class="text-gray-500 text-sm mt-1 tool-desc">${tool.desc}</p>
                <a href="#" class="inline-block mt-4 bg-blue-50 text-blue-700 font-semibold py-2 px-4 rounded-md hover:bg-blue-100 transition-colors">Use Tool</a>
            </div>
        `).join('');

        return `
            <section class="tool-section my-16">
                <h2 class="text-3xl font-bold text-gray-800">${section.category}</h2>
                <p class="text-gray-500 mt-2">${section.description}</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                    ${toolsHtml}
                </div>
            </section>
        `;
    }).join('');

    toolsContainer.innerHTML = allSectionsHtml;
}

/**
 * Sets up the mobile menu toggle functionality.
 */
function setupMobileMenu() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            mobileMenuButton.setAttribute('aria-expanded', !isHidden);
        });
    }
}

/**
 * Sets up the live search functionality for tools.
 */
function setupLiveSearch() {
    const searchInput = document.getElementById('tool-search');
    if (!searchInput) return;

    searchInput.addEventListener('keyup', (event) => {
        const query = event.target.value.toLowerCase().trim();
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

// --- App Initialization ---
generateTools();
setupMobileMenu();
setupLiveSearch();
