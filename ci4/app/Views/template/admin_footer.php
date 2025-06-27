<style>
/* Footer Styles */
footer {
  background-color: #ffffff;
  padding: 2rem 0;
  margin-top: 3rem;
  border-top: 1px solid #e5e7eb;
}

footer p {
  text-align: center;
  color: #6b7280;
  font-size: 0.875rem;
  margin: 0;
}

/* Section Styles */
section {
  padding: 2rem 0;
  max-width: 1200px;
  margin: 0 auto;
}

/* Container Styles */
.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  section {
    padding: 1.5rem 0;
  }

  .container {
    padding: 0 1rem;
  }
}

/* Modern Enhancements */
footer {
  box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.05);
  background-color: #f9fafb;
}

section {
  animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

<footer>
  <div class="container">
    <p>&copy; 2021 - Universitas Pelita Bangsa. All rights reserved.</p>
  </div>
</footer>