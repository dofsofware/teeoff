# TeeOff Technologies SN — Leonardo AI Prompt Library

Purpose: generate every image and video asset needed for the TeeOff Technologies SN
WordPress website, based on `cahier.txt`. All assets must stay consistent with the
brand identity below — copy the **Style Block** into every generation as a base,
then add the specific prompt for the asset you need.

The reference numbers below (2.1, 4.1, 7.3, 15.1, ...) are the exact IDs used
throughout the `teeoff` WordPress theme (`wp-content/themes/teeoff/`). Every spot
on the live site that still needs a real photo/illustration/video shows a dashed
placeholder with the matching number — generate that prompt, then upload the
result as the featured image / Customizer media field it corresponds to.

---

## 0. Brand Style Block (append to every prompt)

**Primary color:** `#121F4B` — deep navy / midnight blue
**Secondary color:** `#FFB920` — warm amber / gold

Base style suffix to append at the end of EVERY prompt in this document:

```
color palette strictly deep navy blue #121F4B and warm amber gold #FFB920, with white
and light neutral grays as supporting colors, modern African tech company aesthetic,
clean and minimal composition, professional corporate design, soft ambient lighting,
subtle glowing accents in amber gold, high-tech futuristic but warm and human feel,
flat modern illustration mixed with soft 3D shapes, generous negative space for text
overlay, ultra clean vector-like rendering, high resolution, sharp focus, no clutter
```

**Global negative prompt** (use for every generation):

```
text, watermark, logo, signature, low quality, blurry, distorted hands, extra limbs,
clashing colors, neon pink, neon green, purple, red, busy background, cluttered,
stock-photo cliché, dated technology, cables, old telephone handset, cartoonish,
childish, low contrast, dark and gloomy, western-only cast, europe-only setting
```

**Recommended Leonardo AI setup:**
- Model: Leonardo Phoenix 1.0 or Flux Dev for photoreal people scenes, PhotoReal v2
  preset for hero photos, Leonardo Vision XL / Illustration preset for flat icons
  and illustrations.
- Guidance scale: 7–9
- Preset style: "3D Render" for icons, "Cinematic" for hero photos, "Illustration"
  for section icons/steps.
- Generate at the aspect ratio noted per asset (use Leonardo's custom dimensions
  or the closest preset).

**Note:** small functional UI icons (the "Pourquoi TeeOff" icons, the "Comment ça
fonctionne" step icons, the solution-card icons, the values icons) are hand-coded
inline SVG in the theme (`inc/icons.php`) and do NOT need Leonardo generation —
only the big photographic/illustrative visuals below do.

---

## 1. Brand / Core Assets

### 1.2 Open Graph / social share image — theme ref `teeoff_og_image`
```
Wide banner composition, a hand holding a simple classic mobile phone to the ear
in the foreground silhouette, radiating amber gold sound wave circles behind it
representing a voice call connecting to a network of small icons (a stethoscope,
a book, a house, a praying hands symbol) floating softly in the deep navy
background, clean corporate tech banner, space reserved on the left third for a
logo and tagline, [STYLE BLOCK]
```
Aspect ratio: 1200x630 (OG standard)

Do NOT use Leonardo to generate the official TeeOff logo — it must come from
TeeOff directly (cahier §19, §29).

---

## 2. Homepage — Hero Section (§5) — theme ref `2.1` / Customizer `teeoff_hero_image`

```
A confident African woman in modern professional attire standing in a warm rural
market street in Senegal, gently holding a simple classic mobile phone to her ear,
soft golden hour sunlight, a subtle overlay of glowing amber gold sound wave
rings emanating from the phone toward the sky, deep navy blue gradient sky
transitioning into the wave graphics, sense of connection and accessibility,
inspiring and warm mood, cinematic photography, shallow depth of field,
[STYLE BLOCK]
```
Aspect ratio: 16:9 full-bleed (1920x1080 or larger — fills the whole hero section).

---

## 3. Homepage — "Notre mission" Section (§5) — theme ref `3.1` / `teeoff_mission_image`

```
Minimal abstract illustration of a phone call icon transforming into a stream
of small glowing icons representing essential services — a heart/health cross,
an open book, a house, a praying hands symbol — flowing outward like a signal
wave, deep navy background with amber gold glowing line art, flat modern vector
illustration, symbolizing access to essential services through a phone call,
[STYLE BLOCK]
```
Aspect ratio: 1:1 (1600x1600)

---

## 4. "Nos solutions" Card Images (§6 & §13) — theme refs `4.1`–`4.4`

Used as the featured image on each `solution` post (Santé, Éducation, Guides
pratiques, Religion & Culture). Generate as a matching set (same lighting,
same framing) so the grid feels cohesive.

### 4.1 Santé
```
A warm and reassuring scene of a rural community health worker in Senegal
speaking calmly on a basic mobile phone, soft indoor clinic lighting, subtle
amber gold sound-wave graphic overlay suggesting a voice health consultation,
deep navy vignette at edges, documentary-style professional photography,
[STYLE BLOCK]
```

### 4.2 Éducation
```
A young student in a village setting listening attentively to a mobile phone
speaker, notebook open beside them, warm natural light, subtle amber gold sound
wave graphic flowing from the phone into small floating icons of a book and a
pencil, deep navy soft vignette, documentary-style professional photography,
[STYLE BLOCK]
```

### 4.3 Guides pratiques
```
A farmer in a Senegalese field holding a basic mobile phone, listening to
guidance, tools and crops softly visible around him, warm daylight, subtle
amber gold sound-wave overlay connecting the phone to small floating icons of
a wheat stalk, a document, and a shield, deep navy vignette, documentary-style
professional photography, [STYLE BLOCK]
```

### 4.4 Religion & Culture
```
An elderly person sitting peacefully under a large tree in a village courtyard,
holding a basic mobile phone to their ear with a calm expression, warm late
afternoon light, subtle amber gold sound-wave overlay suggesting spoken cultural
storytelling, deep navy vignette, documentary-style professional photography,
[STYLE BLOCK]
```
Aspect ratio for all four: 4:3 (1600x1200) — matches the `teeoff-card` image size.

---

## 7. "Notre technologie" (§9 & §14) — theme refs `7.1`–`7.6`

### 7.1 Section / page banner — Customizer `teeoff_technology_poster`
```
Abstract technological composition representing voice AI: a stylized sound
waveform flowing through a subtle circuit-board pattern, transforming into a
glowing amber gold speech bubble, deep navy background with fine light grid
lines suggesting network infrastructure, futuristic yet warm and approachable,
wide banner illustration, [STYLE BLOCK]
```
Aspect ratio: 21:9 (2400x1000)

### 7.2 Interface vocale
```
Abstract icon-illustration of a microphone/sound wave merging with a human
silhouette profile speaking, glowing amber gold wave lines, deep navy
background, minimal tech illustration, [STYLE BLOCK]
```

### 7.3 Téléphonie
```
Abstract icon-illustration of a classic telephone handset connected by a
glowing amber gold line to a network of signal towers, deep navy background,
minimal tech illustration, [STYLE BLOCK]
```

### 7.4 Intelligence artificielle
```
Abstract icon-illustration of a stylized neural network / brain made of soft
glowing nodes and connecting lines in amber gold, integrated with a sound wave
shape, deep navy background, minimal tech illustration, [STYLE BLOCK]
```

### 7.5 Multilinguisme
```
Abstract icon-illustration of a sound waveform splitting into three different
colored speech bubbles each with a subtle abstract script pattern representing
different local languages, amber gold and white accents, deep navy background,
minimal tech illustration, [STYLE BLOCK]
```

### 7.6 Accessibilité sans Internet
```
Abstract icon-illustration of a basic mobile phone with radiating sound waves
instead of wifi signal, a small crossed-out wifi icon subtly in the corner,
amber gold glow, deep navy background, minimal tech illustration, [STYLE BLOCK]
```
Aspect ratio for 7.2–7.6: 1:1 (900x900), used as circular icons on the
Technologie page.

---

## 8. "Nos partenaires" (§10) — theme ref `8.2`

### 8.2 Generic "partnership" illustration — used until real partner logos exist
```
Flat minimal illustration of two hands meeting in a handshake formed out of
glowing amber gold circuit-line patterns, deep navy background, symbolizing
technology partnership, clean vector corporate illustration, [STYLE BLOCK]
```
Aspect ratio: 1:1 (1200x1200)

---

## 9. Actualités / Blog (§11) — theme refs `9.1`–`9.6`

### 9.2–9.6 Generic article placeholders (rotate across news posts)
```
Flat illustration of a phone screen unveiling a glowing new service icon with
a subtle amber gold burst effect behind it, deep navy background, editorial
illustration style for a news article, [STYLE BLOCK]
```
```
Flat illustration of two abstract geometric shapes locking together like
puzzle pieces, one deep navy one amber gold, subtle glow at the seam,
editorial illustration style for a news article, [STYLE BLOCK]
```
```
Flat illustration of a stylized stage/podium with a glowing amber gold
spotlight and small audience silhouettes, deep navy background, editorial
illustration style for a news article, [STYLE BLOCK]
```
```
Flat illustration of a lightbulb formed from a sound-wave outline, glowing
amber gold, deep navy background with faint circuit lines, editorial
illustration style for a news article, [STYLE BLOCK]
```
```
Flat illustration of a speech bubble containing a soft five-star rating shape,
glowing amber gold outline, deep navy background, warm and trustworthy mood,
editorial illustration style for a news article, [STYLE BLOCK]
```
Aspect ratio: 4:3 (1600x1200) for the blog grid, 16:9 for a single article's
main image.

---

## 10. À propos Page (§12) — theme refs `10.1` / `10.2`

### 10.1 "Qui sommes-nous" team visual — Customizer `teeoff_about_team_image`
```
A diverse small team of African tech professionals collaborating around a
table with a laptop and a mobile phone, warm modern office with large windows,
soft daylight, subtle amber gold accent lighting, deep navy accent wall in the
background, professional corporate photography, natural candid mood,
[STYLE BLOCK]
```
Aspect ratio: 4:3 (1600x1200)

### 10.2 "Notre vision" abstract visual — Customizer `teeoff_about_vision_image`
```
Abstract wide illustration of a glowing amber gold horizon line rising over a
stylized silhouette of African villages and city skylines connected by soft
sound-wave arcs, deep navy sky, inspiring and hopeful mood, minimal
illustration, [STYLE BLOCK]
```
Aspect ratio: 16:9 full-bleed background

---

## 11. Technologie Page hero (§14) — theme ref `11.1` / `teeoff_tech_hero_image`

```
Wide cinematic composition, a stylized human silhouette speaking into a soft
glowing amber gold sound wave that transforms mid-air into a network of
connected icons (phone tower, AI node, globe, speech bubble) against a deep
navy gradient background with fine circuit-line texture, futuristic but warm,
[STYLE BLOCK]
```
Aspect ratio: 21:9 full-bleed background

---

## 12. Contact & Partnership (§15, §16) — theme refs `12.1` / `12.2`

### 12.1 Contact illustration — Customizer `teeoff_contact_image`
```
Flat modern illustration of an open envelope merging with a phone handset and
a small glowing amber gold location pin, deep navy background with soft light
grid, warm and welcoming corporate illustration, [STYLE BLOCK]
```

### 12.2 "Devenir partenaire" illustration — Customizer `teeoff_partnership_image`
```
Flat modern illustration of a handshake formed from two glowing puzzle-piece
shapes in deep navy and amber gold, a small document icon floating beside it,
clean corporate illustration for a partnership application section,
[STYLE BLOCK]
```
Aspect ratio: 4:3 (1600x1200)

---

## 13. Carrières Page (§17) — theme ref `13` / `teeoff_careers_image`

```
A warm, modern African office scene with young professionals working
collaboratively, one person on a phone call, natural light, subtle amber gold
accent details in the furniture/signage, deep navy accent wall with the
company's abstract sound-wave motif, professional corporate photography style,
inspiring workplace mood, [STYLE BLOCK]
```
Aspect ratio: 16:9 full-bleed background

---

## 14. Error / Utility Pages — theme ref `14.1` / `teeoff_404_image`

```
Playful but professional flat illustration of a phone call icon with a soft
"lost signal" broken sound-wave line, a magnifying glass searching nearby,
deep navy background with amber gold accents, friendly and reassuring mood,
minimal vector illustration, [STYLE BLOCK]
```
Aspect ratio: 4:3 (1600x1200)

---

## 15. Videos (Leonardo AI Motion / Image-to-Video)

Generate the base still image first from the matching prompt above, then use
Leonardo's Motion (Image-to-Video) feature with these motion prompts. Keep
clips short (4–8s) and seamlessly loopable. Upload the resulting .mp4 in the
Customizer field named.

### 15.1 Hero background loop — Customizer `teeoff_hero_video`
Base image: 2.1
```
Subtle slow motion of glowing amber gold sound waves gently pulsing and
radiating outward from a phone, soft ambient light drifting across a deep navy
background, camera very slight slow push-in, calm and premium motion, seamless
loop, no fast movement, cinematic ambient tech loop
```
Motion strength: low-medium · Duration: 5–8s · Loop: yes

### 15.3 "Notre technologie" ambient background loop — Customizer `teeoff_technology_video`
Base image: 7.1
```
Slow ambient animation of glowing amber gold circuit lines flowing like data
pulses through a deep navy network pattern, soft waveform pulsing in the
center, premium tech ambiance, seamless loop, subtle parallax depth
```
Motion strength: low · Duration: 6–8s · Loop: yes

### 15.5 Social media teaser (square, for Instagram/LinkedIn — not embedded on-site)
Base image: 1.2 or 4.1–4.4
```
Smooth motion graphic reveal, sound wave rippling outward from a phone icon,
small service icons (health, education, guides, culture) elegantly fading in
one after another with amber gold glow, deep navy background, upbeat but
professional pacing, ends on a clean still frame with space reserved for
logo/text overlay
```
Aspect ratio: 1:1 · Duration: 8–10s

---

## 16. Notes on usage

- Keep amber gold (#FFB920) as an *accent*, never the dominant fill color —
  deep navy (#121F4B) should carry 60–70% of the visual weight in photographic
  scenes, per cahier §19 (moderne, professionnelle, technologique, épurée,
  adaptée à une entreprise africaine innovante).
- For any prompt involving people, prioritize authentic West African /
  Senegalese settings and cast, both urban and rural (cahier §3, §5) — avoid a
  generic stock-photo look.
- Do NOT use Leonardo to generate the official TeeOff logo or partner logos —
  those must come from TeeOff and its partners directly (§19, §29).
- Where to upload once generated:
  - Refs `4.x` → featured image of the matching `Solution` post
    (wp-admin → Solutions).
  - Refs `9.x` → featured image of each `Actualités` post.
  - All other refs (`2.1`, `3.1`, `7.1`, `8.2`, `10.x`, `11.1`, `12.x`, `13`,
    `14.1`, `15.x`, `1.2`) → Apparence → Personnaliser → the matching "Médias"
    section, under the field named in this document.
- Export final selects as WebP/AVIF where possible per the performance
  requirements in §23.
