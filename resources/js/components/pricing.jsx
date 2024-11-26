import { Button } from '@/components/ui/button.jsx'
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card.jsx'
import { motion } from 'framer-motion'
import { Check } from 'lucide-react'

export default function Pricing() {
  const plans = [
    {
      name: 'Starter',
      price: '$29',
      features: ['Up to 1,000 monthly active users', '5 social login providers', 'Basic support']
    },
    {
      name: 'Pro',
      price: '$99',
      features: ['Up to 10,000 monthly active users', 'All social login providers', 'Priority support']
    },
    {
      name: 'Enterprise',
      price: 'Custom',
      features: ['Unlimited monthly active users', 'Custom integrations', '24/7 dedicated support']
    }
  ]

  return (
    <section className='w-full bg-white py-12 md:py-24 lg:py-32'>
      <div className='container mx-auto max-w-6xl px-4 md:px-6'>
        <motion.h2
          className='mb-12 text-center text-3xl font-bold tracking-tighter sm:text-5xl'
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
        >
          Simple, Transparent Pricing
        </motion.h2>
        <div className='grid grid-cols-1 gap-8 md:grid-cols-3'>
          {plans.map((plan, index) => (
            <motion.div
              key={index}
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: index * 0.1, duration: 0.5 }}
              whileHover={{ scale: 1.05 }}
              whileTap={{ scale: 0.95 }}
            >
              <Card>
                <CardHeader>
                  <CardTitle>{plan.name}</CardTitle>
                </CardHeader>
                <CardContent>
                  <p className='mb-6 text-4xl font-bold'>
                    {plan.price}
                    <span className='text-xl font-normal'>/mo</span>
                  </p>
                  <ul className='mb-6 flex-grow'>
                    {plan.features.map((feature, featureIndex) => (
                      <li key={featureIndex} className='mb-2 flex items-center'>
                        <Check className='mr-2 h-5 w-5 text-green-500' />
                        <span>{feature}</span>
                      </li>
                    ))}
                  </ul>
                </CardContent>
                <CardFooter>
                  <Button className='w-full'>Choose Plan</Button>
                </CardFooter>
              </Card>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  )
}
