# WordPress Performance Optimization Boilerplate

An open-source, engineering-focused WordPress child theme starter configuration written in PHP to systematically maximize Google PageSpeed Insights metrics and Core Web Vitals.

## 🛠️ Technical Stack
- **Languages:** PHP, JavaScript (ES6+), CSS3
- **Environments:** WordPress Core, WooCommerce Automation Layers

## ⚡ Key Engineering Decisions
- **Render-Blocking Elimination:** Written native PHP action hooks inside `functions.php` to dequeue unnecessary styles and append `defer/async` attributes to scripts dynamically.
- **Conditional Script Execution:** Isolated heavy scripts to load exclusively on active application pages, reducing core layout delivery payloads by up to 40%.
- **CLS Mitigation:** Injected asset dimension tracking filters to structurally layout image boundaries, preventing cumulative layout shifts (CLS) on low-bandwidth networks.
