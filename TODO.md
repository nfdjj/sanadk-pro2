# TODO - Fix Phone/WhatsApp Number Saving, Responsive Images & Admin Mobile Layout

## Task
1. Admin panel phone number changes are not saved to the database because the controllers drop the fields during validation.
2. Images not fitting properly on all screen sizes (phone, laptop, pc).
3. Admin pages not fitting properly on phone.

## Steps
- [x] Investigate why phone number doesn't change (root cause identified)
- [x] Fix `HeroController@saveHero` - add `whatsapp_number` to validation
- [x] Fix `ServiceController@saveService` - add `whatsapp_number` and `phone_number` to validation
- [x] Fix responsive images - global `img { max-width:100%; height:auto }` rule
- [x] Fix service card images - use `aspect-ratio` + `object-fit: cover` instead of fixed height
- [x] Fix broken `card4.jpg` fallback references (file doesn't exist) → use existing `card3.jpg`
- [x] Fix hero/services background images (`background-attachment: fixed` broke on mobile)
- [x] Add mobile-specific image aspect ratio (4/3) for small screens
- [x] Fix admin dashboard sidebar for mobile (fixed 280px → responsive top bar)
- [x] Fix admin account page sidebar for mobile
- [x] Add `data-label` attributes to admin content table for mobile card layout

