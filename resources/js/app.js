import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", function () {
    // ============================================
    // HERO — Staggered entrance
    // ============================================

    const heroTl = gsap.timeline({ defaults: { ease: "power3.out" } });

    heroTl
        .from("#nav", { y: -40, opacity: 0, duration: 0.6 })
        .from(".hero-badge", { y: 16, opacity: 0, duration: 0.5 }, "-=0.2")
        .from(
            ".hero-title",
            { y: 30, opacity: 0, duration: 0.7, clearProps: "all" },
            "-=0.3",
        )
        .from(".hero-subtitle", { y: 20, opacity: 0, duration: 0.6 }, "-=0.35")
        .from(".hero-cta", { y: 20, opacity: 0, duration: 0.6 }, "-=0.3")
        .from(".hero-stats", { y: 20, opacity: 0, duration: 0.6 }, "-=0.3");

    // Hero card — slides in from right with slight rotation
    heroTl.from(
        ".hero-card",
        {
            x: 60,
            opacity: 0,
            rotateY: 6,
            duration: 0.9,
            ease: "power3.out",
            clearProps: "transform",
        },
        "-=0.8",
    );

    // Chart bars grow up
    gsap.from(".chart-bar", {
        scaleY: 0,
        transformOrigin: "bottom",
        duration: 0.5,
        stagger: 0.08,
        delay: 1.4,
        ease: "back.out(1.7)",
    });

    // ============================================
    // HERO — Transaction rows cascade
    // ============================================

    const transactions = document.querySelectorAll(".transaction");
    transactions.forEach((row, index) => {
        const icon = row.querySelector(".txn-icon");

        const tl = gsap.timeline({ delay: 1.6 + index * 0.12 });

        tl.from(row, {
            y: -20,
            opacity: 0,
            scale: 0.98,
            duration: 0.45,
            ease: "power3.out",
        });

        if (icon) {
            tl.from(
                icon,
                {
                    scale: 0,
                    rotate: row.classList.contains("income") ? 180 : -180,
                    duration: 0.35,
                    ease: "back.out(2)",
                },
                "-=0.25",
            );
        }
    });

    // ============================================
    // MARQUEE — infinite scroll
    // ============================================

    const marquee = document.querySelector(".marquee-track");
    if (marquee) {
        // Duplicate content for seamless loop
        marquee.innerHTML += marquee.innerHTML;
        const totalWidth = marquee.scrollWidth / 2;

        gsap.to(marquee, {
            x: -totalWidth,
            duration: 30,
            ease: "none",
            repeat: -1,
        });
    }

    // ============================================
    // FEATURES — Bento grid reveal
    // ============================================

    gsap.from(".features-header", {
        opacity: 0,
        y: 30,
        duration: 0.7,
        scrollTrigger: {
            trigger: ".features-header",
            start: "top 85%",
            toggleActions: "play none none reverse",
        },
    });

    const featureItems = document.querySelectorAll(".feature-item");
    featureItems.forEach((item, i) => {
        gsap.from(item, {
            opacity: 0,
            y: 40,
            scale: 0.96,
            duration: 0.6,
            delay: i * 0.08,
            scrollTrigger: {
                trigger: item,
                start: "top 88%",
                toggleActions: "play none none reverse",
            },
            ease: "power3.out",
        });
    });

    // ============================================
    // HOW IT WORKS — Steps
    // ============================================

    gsap.from(".how-header", {
        opacity: 0,
        y: 30,
        duration: 0.7,
        scrollTrigger: {
            trigger: ".how-header",
            start: "top 85%",
            toggleActions: "play none none reverse",
        },
    });

    const steps = document.querySelectorAll(".step-item");
    steps.forEach((step, i) => {
        gsap.from(step, {
            opacity: 0,
            y: 30,
            duration: 0.6,
            delay: i * 0.15,
            scrollTrigger: {
                trigger: step,
                start: "top 88%",
                toggleActions: "play none none reverse",
            },
            ease: "power3.out",
        });
    });

    // ============================================
    // CTA — Scale in
    // ============================================

    gsap.from(".cta-section", {
        opacity: 0,
        scale: 0.95,
        y: 30,
        duration: 0.8,
        scrollTrigger: {
            trigger: ".cta-section",
            start: "top 85%",
            toggleActions: "play none none reverse",
        },
        ease: "power3.out",
    });

    // ============================================
    // SCREENSHOTS — Staggered cards
    // ============================================

    gsap.from(".screenshots-header", {
        opacity: 0,
        y: 30,
        duration: 0.7,
        scrollTrigger: {
            trigger: ".screenshots-header",
            start: "top 85%",
            toggleActions: "play none none reverse",
        },
    });

    const screenshotItems = document.querySelectorAll(".screenshot-item");
    screenshotItems.forEach((item, i) => {
        gsap.from(item, {
            opacity: 0,
            y: 50,
            scale: 0.94,
            duration: 0.7,
            delay: i * 0.15,
            scrollTrigger: {
                trigger: ".screenshots-grid",
                start: "top 85%",
                toggleActions: "play none none reverse",
            },
            ease: "power3.out",
        });
    });

    // ============================================
    // DOWNLOAD — Section reveal
    // ============================================

    const downloadSection = document.querySelector(".download-section");
    if (downloadSection) {
        gsap.from(downloadSection, {
            opacity: 0,
            y: 40,
            duration: 0.8,
            scrollTrigger: {
                trigger: downloadSection,
                start: "top 85%",
                toggleActions: "play none none reverse",
            },
            ease: "power3.out",
        });

        // Phone mockup float in
        const phoneMockup = document.querySelector(".phone-mockup");
        if (phoneMockup) {
            gsap.from(phoneMockup, {
                opacity: 0,
                y: 40,
                rotateZ: 5,
                duration: 0.9,
                delay: 0.3,
                scrollTrigger: {
                    trigger: downloadSection,
                    start: "top 80%",
                    toggleActions: "play none none reverse",
                },
                ease: "back.out(1.4)",
            });
        }
    }

    // ============================================
    // HOVER micro-interactions on feature cards
    // ============================================

    featureItems.forEach((card) => {
        card.addEventListener("mouseenter", () => {
            gsap.to(card, {
                y: -6,
                duration: 0.3,
                ease: "power2.out",
                overwrite: "auto",
            });
        });
        card.addEventListener("mouseleave", () => {
            gsap.to(card, {
                y: 0,
                duration: 0.3,
                ease: "power2.out",
                overwrite: "auto",
            });
        });
    });
});
