---
name: Kawaii Pop E-Commerce
colors:
  surface: '#fcf9f8'
  surface-dim: '#dcd9d9'
  surface-bright: '#fcf9f8'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f6f3f2'
  surface-container: '#f0eded'
  surface-container-high: '#eae7e7'
  surface-container-highest: '#e5e2e1'
  on-surface: '#1b1c1c'
  on-surface-variant: '#53424b'
  inverse-surface: '#303030'
  inverse-on-surface: '#f3f0ef'
  outline: '#86727b'
  outline-variant: '#d8c0cb'
  surface-tint: '#9e357b'
  primary: '#9e357b'
  on-primary: '#ffffff'
  primary-container: '#ff85d0'
  on-primary-container: '#7a135d'
  inverse-primary: '#ffaedb'
  secondary: '#705d00'
  on-secondary: '#ffffff'
  secondary-container: '#fdd73b'
  on-secondary-container: '#715d00'
  tertiary: '#006687'
  on-tertiary: '#ffffff'
  tertiary-container: '#38bbef'
  on-tertiary-container: '#004860'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ffd8eb'
  primary-fixed-dim: '#ffaedb'
  on-primary-fixed: '#3c002b'
  on-primary-fixed-variant: '#811962'
  secondary-fixed: '#ffe173'
  secondary-fixed-dim: '#e8c426'
  on-secondary-fixed: '#221b00'
  on-secondary-fixed-variant: '#554500'
  tertiary-fixed: '#c1e8ff'
  tertiary-fixed-dim: '#73d2ff'
  on-tertiary-fixed: '#001e2b'
  on-tertiary-fixed-variant: '#004d66'
  background: '#fcf9f8'
  on-background: '#1b1c1c'
  surface-variant: '#e5e2e1'
typography:
  headline-xl:
    fontFamily: Plus Jakarta Sans
    fontSize: 48px
    fontWeight: '800'
    lineHeight: 56px
    letterSpacing: -1px
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '800'
    lineHeight: 40px
  headline-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 28px
    fontWeight: '800'
    lineHeight: 36px
  body-lg:
    fontFamily: Be Vietnam Pro
    fontSize: 18px
    fontWeight: '600'
    lineHeight: 28px
  body-md:
    fontFamily: Be Vietnam Pro
    fontSize: 16px
    fontWeight: '500'
    lineHeight: 24px
  label-bold:
    fontFamily: Rubik
    fontSize: 14px
    fontWeight: '700'
    lineHeight: 20px
  price-display:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '800'
    lineHeight: 32px
rounded:
  sm: 0.5rem
  DEFAULT: 1rem
  md: 1.5rem
  lg: 2rem
  xl: 3rem
  full: 9999px
spacing:
  unit: 8px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 64px
  section-gap: 80px
---

## Brand & Style

This design system is built on a "Maximalist Kawaii" aesthetic, blending high-energy Japanese pop culture influences with bold, comic-inspired UI. The brand personality is unapologetically fun, energetic, and youthful, designed to turn a standard e-commerce transaction into an expressive, toy-like experience. 

The style utilizes a **Bold / High-Contrast** approach with a heavy dose of **Tactile** playfulness. It ignores traditional minimalist restraint in favor of thick "ink" outlines, saturated color blocks, and decorative flourishes like sparkles and hand-drawn stickers. The emotional goal is to evoke joy and "clutter-core" excitement, making every product feel like a collectible item in a vibrant cartoon world.

## Colors

The palette is a high-saturation explosion of "candy-shop" tones. 
- **Primary (Bubblegum Pink):** Used for main CTAs, branding elements, and primary buttons.
- **Secondary (Sunny Yellow):** Used for alerts, star ratings, and promotional banners.
- **Tertiary (Sky Blue):** Used for informational badges, links, and secondary interactive elements.
- **Quaternary (Lime Green):** Used for "Success" states, price tags, and discounts.
- **Neutral (Ink Black):** Used exclusively for thick borders (3px-4px) and high-contrast typography to ground the bright colors.

Backgrounds should rarely be flat white. Instead, use light tints of the primary colors or bold patterns such as oversized polka dots or diagonal "candy" stripes to maintain high energy.

## Typography

Typography in this design system must feel "chunky" and hand-drawn. We use **Plus Jakarta Sans** for headlines because of its friendly, exaggeratedly round counters and bold weight. **Be Vietnam Pro** provides a warm and approachable feel for body copy, while **Rubik** is used for UI labels to maintain a playful, geometric consistency.

All headlines should be set in extra-bold weights. For a true "cartoon" feel, larger headings can be styled with a 2px outside stroke in the Neutral Ink color or a thick offset drop shadow to make the text pop off the patterned backgrounds.

## Layout & Spacing

The layout follows a **Fluid Grid** model with high-density spacing. Unlike minimalist systems that prioritize "breathing room," this system embraces a "packed" look. 
- **Grid:** A 12-column grid for desktop and a 2-column grid for mobile.
- **Gutters:** Large 24px gutters provide clear separation between the thick-bordered cards.
- **Rhythm:** Spacing should follow 8px increments. Use generous internal padding within containers (minimum 24px) to ensure that the thick borders do not crowd the content.
- **Maximalist Accents:** Negative space should be filled with "sparkle" icons or decorative stickers (e.g., a cartoon heart or star) near the corners of sections to maintain the busy, fun aesthetic.

## Elevation & Depth

This system rejects soft, realistic shadows in favor of **Hard-Edge Comic Shadows**. 
- **Shadows:** Use 100% opacity shadows offset by 4px or 8px (bottom-right). The shadow color should be the Neutral Ink color or a significantly darker shade of the element's base color.
- **Borders:** Every interactive or container element must have a 3px or 4px solid black border. 
- **Layering:** Hierarchy is created by "stacking" blocks. Higher elevation is indicated by a larger shadow offset, making the element appear to hover further away from the patterned background.
- **Stickers:** Decorative elements (sparkles, stars, smiley faces) should be treated as "overlays" that break the bounding box of containers, adding to the uncontained, high-energy feel.

## Shapes

The shape language is dominated by **Hyper-Roundedness**. Every corner should be soft and inviting to mimic the look of vinyl toys and stickers.
- **Containers:** All product cards and modals use `rounded-xl` (1.5rem / 24px).
- **Interactive Elements:** Buttons and tags use a full pill-shape (`rounded-full`) to emphasize their "squishy" and tactile nature.
- **In-set Elements:** Even small elements like checkboxes or input fields must have a minimum of 8px corner radius. Sharp 90-degree angles are strictly forbidden.

## Components

### Buttons
Buttons are "chunky" and highly tactile. They feature a 4px solid border, a primary color fill (Pink or Green), and a thick 4px-8px hard drop shadow. On hover, the button should shift 2px down and to the right, simulating a physical "press" that partially collapses the shadow.

### Cards
Product cards should have a white or light-yellow background with a 3px border. The product image should be centered with a slight rotation (±3 degrees) to feel like a sticker placed on a page. Price tags should be rendered as a quaternary-colored "burst" or "star" shape.

### Input Fields
Fields use a thick 3px border and a subtle "inner shadow" at the top to create a recessed look. The focus state replaces the black border with a bright Sky Blue border and a glowing outer shadow.

### Stickers & Badges
Use decorative "stickers" (hand-drawn style icons) to highlight features like "New!" or "Sale!". These should be tilted at playful angles and feature a white "die-cut" border effect around them before the final black outline.

### Checkboxes & Radios
These should be oversized (minimum 24x24px) with thick borders. When checked, use a chunky "X" or a "Smile" icon instead of a standard checkmark.